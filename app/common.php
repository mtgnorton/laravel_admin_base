<?php


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use \Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

function db_start_trans()
{
    DB::beginTransaction();
}


function db_rollBack(int $toLevel = null)
{
    DB::rollBack($toLevel);
}


function db_commit()
{
    DB::commit();
}


/**
 * author: mtg
 * time: 2021/2/24   18:09
 * function description: 获取全局设置值
 * @param $keys  string|array 如 site_name或['site_name','bucket']或['site.site_name','storage.bucket']
 * @param $default string|null 当不存在时的默认值
 * @return \Illuminate\Support\Collection|mixed
 */
function conf($keys, $default = null)
{

    $isSingle = false;
    if (!is_array($keys)) {
        $keys     = array($keys);
        $isSingle = true;
    }


    $configs = Cache::remember('configs', 300, function () {

        $configs             = \App\Model\Config::get();
        $configsWithKey      = $configs->mapWithKeys(function ($item) {
            return [
                $item['key'] => $item
            ];
        })->toArray();
        $configWithKeyModule = $configs->mapWithKeys(function ($item) {
            return [
                $item['key'] . $item['module'] => $item
            ];
        })->toArray();

        return array_merge($configsWithKey, $configWithKeyModule);
    });

    $result = [];
    foreach ($keys as $key) {
        $module = '';
        if (Str::contains($key, '.')) {
            $module = explode('.', $key)[0];
            $key    = explode('.', $key)[1];
        }
        $item = data_get($configs, $key . $module);

        $result[$key] = $item['is_json'] ? json_decode($item['value'], true) : $item['value'];
    }
    if ($isSingle) {
        return current($result) ?? $default;
    }
    return $result;
}

/**
 * author: mtg
 * time: 2020/12/14   10:18
 * function description: 简介获取general文件的翻译
 * @param $key
 * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
 */
function ll($key, $replace = [], $locale = null)
{
    $key = trim($key);

    if (strpos($key, '.') !== false) {
        return __($key, $replace, $locale);
    }
    $content = __("general." . $key, $replace, $locale);

    return Str::replaceFirst('general.', '', $content);
}


/**
 * author: mtg
 * time: 2020/12/9   16:25
 * function description: 表单提交是否是创建
 * @param \Encore\Admin\Form $form
 * @return bool
 */
function form_is_create(\Encore\Admin\Form $form): bool
{
    return !$form->model()->id;
}


/**
 * author: mtg
 * time: 2020/12/10   9:44
 * function description: 抛出一个api异常
 * @param  $error
 */
function new_api_exception($error, $code = 400)
{

    db_rollBack(0);
    common_log($error);
    throw new \App\ApiException($error, $code);
}


/**
 * author: mtg
 * time: 2020/12/10   15:58
 * function description: 表单验证
 * @param array $data
 * @param array $rules
 */
function form_validate(array $data, array $rules)
{
    $validator = Validator::make($data, $rules);

    $errors = $validator->errors();

    if ($errors->isNotEmpty()) {
        new_api_exception($errors->all());
    }
}

/**
 * author: mtg
 * time: 2020/12/11   10:09
 * function description: 获取sql输出
 * @param $callback
 */

function dump_sql($callback)
{
    DB::connection()->enableQueryLog();

    $callback();

    $queries = DB::getQueryLog();


    $sql = $queries[0]['query'];

    foreach ($queries[0]['bindings'] as $binding) {
        $sql = Str::replaceFirst('?', $binding, $sql);
    }
    dump($queries, $sql);

}


/**
 * author: mtg
 * time: 2019/5/6   16:33
 * function description: 安全的获取数组值,数组可以为多层,如果获取不到返回null
 *
 *  如果数组为 $s['a']['c']['d']= 2;
 *
 *
 *  调用方法为 array_value($s,'a','c','d');
 * @param $arr array 需要获取值的数组
 * @param $key string 获取的键
 * @return mixed|string
 */
function array_value($arr, ...$keys)
{
    if (count($keys) === 0) {
        return $arr;
    }

    if (count($keys) === 1) {
        $key = $keys[0];
        if (!is_array($arr)) {
            return null;
        }

        if (!isset($arr[$key])) {
            return null;
        }
        return $arr[$key];
    }

    $firstKey = array_shift($keys);
    return array_value(array_value($arr, $firstKey), ...$keys);


}


/**
 * author: mtg
 * time: 2019/6/27   14:26
 * function description:获取某一天的日,周,月的开始时间和结束时间,如果不传入$time参数,默认为当天时间
 * @param string $type
 * @param type 0 时间戳格式 1日期格式
 * @param int time 时间戳类型
 * @return array
 */
function get_time_begin_end($scope = "d", $type = 0, $time = null)
{
    $time  = $time ?? system_time();
    $month = date('m', $time);
    $day   = date('d', $time);
    $week  = date('w', $time);
    $year  = date('Y', $time);

    switch ($scope) {
        case 'd':
            $rs = [
                mktime(0, 0, 0, $month, $day, $year),
                mktime(0, 0, 0, $month, $day + 1, $year) - 1,
            ];
            break;
        case 'w':
            $rs = [
                mktime(0, 0, 0, $month, $day - $week + 1, $year),
                mktime(0, 0, 0, $month, $day - $week + 8, $year) - 1,
            ];
            break;
        case 'm':
            $rs = [
                mktime(0, 0, 0, $month, 1, $year),
                mktime(23, 59, 59, $month, date('t'), $year)
            ];
            break;
        default:
            new_api_exception('请传入正确的scope参数');
    }
    if ($type) {
        return [
            format_time_to_string($rs[0]),
            format_time_to_string($rs[1]),
        ];
    }
    return $rs;

}


/**
 * author: mtg
 * time: 2021/2/23   19:39
 * function description:
 * @param int $type 0 当前系统的时间戳,1 当前系统时间的字符串
 * @return false|int|string
 */
function system_time($type = 0)
{
    $nowTime    = time();
    $offsetDay  = conf('time_offset_day');
    $offsetHour = conf('time_offset_hour');
    $offsetDay  = $offsetDay ? $offsetDay : 0;
    $offsetHour = $offsetHour ? $offsetHour : 0;

    $offsetDayTime  = $offsetDay * 86400;
    $offsetHourTime = $offsetHour * 3600;
    $nowTime        = bcadd($nowTime, $offsetDayTime);

    $nowTime = bcadd($nowTime, $offsetHourTime);

    if ($type === 0) {
        return $nowTime;
    }
    return format_time_to_string($nowTime);
}


/**
 * author: mtg
 * time: 2021/2/23   19:42
 * function description:格式化时间戳成为固定字符串
 * @param int|null $time
 * @return false|string
 */
function format_time_to_string(int $time = null)
{

    if (is_null($time)) {
        $time = system_time();
    }
    return date('Y-m-d H:i:s', $time);
}

/**
 * author: mtg
 * time: 2021/1/13   17:18
 * function description: 编辑新增form时居中显示
 * @param \Encore\Admin\Form $form
 * @param $callback
 */
function form_center(\Encore\Admin\Form $form, $callback)
{
    $form->column(1 / 2, $callback);
    $js = <<<EOT
$('.content .fields-group .col-md-6').addClass('col-md-offset-3')
$('.box-footer .col-md-2').removeClass('col-md-2').addClass('col-md-4')
$('.box-footer .col-md-8').removeClass('col-md-8').addClass('col-md-4')
EOT;

    Admin::script($js);
}

function grid_disabled_all(\Encore\Admin\Grid $grid): \Encore\Admin\Grid
{
    $grid->disableFilter();
    $grid->disableCreateButton();
    $grid->disablePagination();
    $grid->disableExport();
    $grid->disableActions();
    $grid->disableColumnSelector();
    $grid->disableRowSelector();

    return $grid;
}


function grid_disabled_new_and_edit(\Encore\Admin\Grid $grid): \Encore\Admin\Grid
{
    $grid->disableCreateButton();
    $grid->actions(function ($actions) {
        $actions->disableView(false);
        $actions->disableEdit();
        $actions->disableDelete();
    });
    return $grid;
}

function show_disabled_edit_and_delete(Encore\Admin\Show $show): \Encore\Admin\Show
{
    $show->panel()
        ->tools(function ($tools) {
            $tools->disableEdit();
            $tools->disableDelete();
        });
    return $show;
}

/**
 * author: mtg
 * time: 2021/2/23   19:17
 * function description:form 保存时返回错误信息
 * @param string $message
 * @return \Illuminate\Http\RedirectResponse
 */
function form_error(string $message)
{

    if (is_admin_ajax()) {
        new_api_exception($message);
    }

    $error = new MessageBag([
        'title'   => 'error',
        'message' => $message,
    ]);
    return back()->with(compact('error'))->withInput();
}


function is_admin_ajax()
{

    return request()->ajax() && request()->header('X-PJAX') != 'true';

}

function human_file_size($size, $unit = ""): string
{
    if ((!$unit && $size >= 1 << 30) || $unit == "GB")
        return number_format($size / (1 << 30), 2) . "GB";
    if ((!$unit && $size >= 1 << 20) || $unit == "MB")
        return number_format($size / (1 << 20), 2) . "MB";
    if ((!$unit && $size >= 1 << 10) || $unit == "KB")
        return number_format($size / (1 << 10), 2) . "KB";
    return number_format($size) . " bytes";
}

function is_win(): bool
{
    return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
}


function curl_post(string $url, array $data = null, $isJSON = false)
{
    $timeBegin = system_time(1);
    common_log("开始执行时间{$timeBegin}");
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);

    if ($isJSON) {
        $data = json_encode($data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    }
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//将 curl_exec()获取的信息以文件流的形式返回，而不是直接输出。

    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);//在使用CURLOPT_FOLLOWLOCATION产生的header中的多个locations中持续追加用户名和密码信息，即使域名已发生改变。
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);//当根据Location:重定向时，自动设置header中的Referer:信息。
    curl_setopt($ch, CURLOPT_MAXREDIRS, 4); //指定最多的HTTP重定向的数量，这个选项是和CURLOPT_FOLLOWLOCATION一起使用的。

    curl_setopt($ch, CURLOPT_ENCODING, ""); //HTTP请求头中"Accept-Encoding: "的值。支持的编码有"identity"，"deflate"和"gzip"。如果为空字符串""，请求头会发送所有支持的编码类型。
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1; zh-CN) AppleWebKit/535.12 (KHTML, like Gecko) Chrome/22.0.1229.79 Safari/535.12");
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); //设置cURL允许执行的最长秒数。

    $result = curl_exec($ch);
    curl_close($ch);

    $jsonDecoding = json_decode($result, true);

    $content = is_null($jsonDecoding) ? $result : $jsonDecoding;

    $timeEnd = system_time(1);
    common_log("结束执行时间{$timeEnd}");
    return $content;
}


function curl_get(string $url, $isReturnJSON = true)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);

    curl_close($ch);

    if ($isReturnJSON) {
        return json_decode($result, true);
    }
    return $result;
}

/**
 * author: mtg
 * time: 2020/11/4   14:55
 * function description: 1.加密参数 2.验证签名
 * @param array $args 参数
 * @param string $sign 签名
 * @param string $key 平台给的密钥
 * @return bool
 */
function collect_sign(array $args, string $key, string $sign = null)
{
    $args['key'] = $key;
    ksort($args);
    $str = http_build_query($args, '', '&');
    common_log("通知加密,加密的参数为: $str");
    $newSign = hash("sha256", $str);

    if (is_null($sign)) {
        return $newSign;
    }
    if ($newSign != $sign) {
        return false;
    }
    return true;
}


/**
 * author: mtg
 * time: 2021/2/23   16:38
 * function description: 百分比字符串转换
 * @param string $radio
 * @return string|null
 */
function radio_transform(string $radio)
{
    if (Str::contains($radio, '%')) {
        $radio = Str::replaceFirst('%', '', $radio);
        $radio = bcdiv($radio, 100);
    }
    return $radio;

}


function full_error_msg(Exception $e)
{
    $trace = $e->getTraceAsString();
    $trace = str_replace("#", "<br/>#", $trace);
    return $errorMsg = $e->getMessage() . "  <br/> file:" . $e->getFile() . "<br/>   line:" . $e->getLine() . "<br/>   trace:" . $trace;

}


function common_log(string $message, $context = [], $channel = '')
{
    if (!is_array($context)) {
        $context = array($context);
    }
    $message = PHP_EOL . $message;
    $message .= PHP_EOL;
    if ($channel) {
        Log::channel($channel)->info($message, $context);
    } else {
        Log::info($message, $context);
    }
}

function sql_log(string $message, $context = [])
{
    common_log($message, $context, 'sql');

}






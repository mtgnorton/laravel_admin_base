<?php

use App\Http\Helpers\ApiException;
use App\Model\Project;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Support\Str;


function db_start_trans()
{
    DB::beginTransaction();
}


function db_rollBack($toLevel = null)
{
    DB::rollBack($toLevel);
}


function db_commit()
{
    DB::commit();
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
    return __("general." . $key, $replace, $locale);
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
function new_api_exception($error, $code = 202)
{

    db_rollBack(0);
    Log::info($error);
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

    dump($queries);
    exit;
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
            api_exception('请传入正确的scope参数');
    }
    if ($type) {
        return [
            get_time_format($rs[0]),
            get_time_format($rs[1]),
        ];
    }
    return $rs;

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

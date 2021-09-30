<?php

namespace App\Admin\Components\Settings;


use App\Model\Config;
use App\Model\Version;
use App\Service\SystemUpdateService;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class SystemUpdate extends Base
{
    public function tabTitle()
    {
        return '系统更新';
    }

    public function handle(Request $request)
    {


        $data = get_remote_all_version_info();


        if (!$data) {
            admin_error('当前已是最新版本');
            return back();
        }

        $data            = array_reverse($data);
        $totalFileAmount = 0;
        $totalSqlAmount  = 0;
        foreach ($data as $item) {

            if (version_compare(conf('update.version', '1.0.0'), $item['version'], '<')) {
                if (!$packURL = data_get($item, 'package')) {
                    admin_error('更新链接不存在,暂时无法更新');
                    return back();
                }


                $rs = SystemUpdateService::update($packURL);


                if (!$rs['state']) {

                    admin_error($rs['message']);
                    return back();
                }
                Config::updateOrInsert(
                    [
                        'module' => 'update',
                        'key'    => 'version',
                    ],
                    [
                        'value' => $item['version']
                    ]
                );
                Config::updateOrInsert(
                    [
                        'module' => 'update',
                        'key'    => 'desc',
                    ],
                    [
                        'value' => $item['desc']
                    ]
                );
                Version::create([
                    'number' => $item['version'],
                    'desc'   => $item['desc']
                ]);
                $totalFileAmount += $rs['amount'];
                $totalSqlAmount  += $rs['sql_amount'];
            }
        }


        admin_success(ll(sprintf('更新成功,共更新%s个文件,共更新%s个sql', $totalFileAmount, $totalSqlAmount)));
        return back();
    }


    public function handleGit(Request $request)
    {

        if (is_win()) {
            admin_error(ll('win not support update'));
            return back();

        }

        if (!function_exists('exec')) {
            admin_error(ll('未开启exec函数,无法更新'));
            return back();
        }

        $output = '';
        $status = '';

        $rs = exec('sudo git reset --hard;sudo git pull 2>&1', $output, $status);

        gather_log($rs . $output . $status);
        if (strpos($rs, 'Already up-to-date') !== false) {
            admin_success('已经是最新版本');
            return back();

        }

        Config::updateOrInsert(
            [
                'module' => 'update',
                'key'    => 'version',
            ],
            [
                'value' => get_remote_latest_version()
            ]
        );

        admin_success(ll('更新成功') . '更新信息为:' . data_get($output, 0));
        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {

        $version = get_remote_latest_version();

        $html = <<<HTML
var h = `<div class="form-group ">
    <label class="col-sm-2  control-label">最新版本号<\/label>
    <div class="col-sm-8">
        <div class="box box-default no-margin">
            <div class="box-body">
            $version
            <button class="btn btn-warning">立即升级</button>
            <\/div>
        <\/div>
    <\/div>
<\/div>`

$('.fields-group .form-group:nth-child(1)').after(h);
HTML;

        $script = <<<HTML
    $('.fields-group').addClass('system_update_form');
HTML;


        Admin::script($script);
        if (version_compare(conf('update.version', '1.0.0'), $version, '<')) {

            $this->display('version', '当前版本')->with(function ($value) {
                return conf('update.version', '1.0.0');
            });
            Admin::script($html);

            $this->textarea('desc', ll('版本描述'))->with(function ($value) {
                return $this->getVersionsDesc();
            })->disable();
        } else {
            $this->display('version', '当前版本')->with(function ($value) {
                return conf('update.version', '1.0.0');
            });
            $this->display('t', '最新版本号')->with(function ($value) {
                return '已是最新版本';
            });
            $this->textarea('desc', ll('版本描述'))->with(function ($value) {
                return $this->getVersionsDesc();
            })->disable();

        }
        $this->disableReset();

        $this->disableSubmit();


    }

    private function getVersionsDesc()
    {
        return Version::all()->reverse()->reduce(function ($initial, $item) {
            return $initial . "版本号为:{$item['number']} 更新描述:{$item['desc']}\r\n";
        }, '');
    }
}

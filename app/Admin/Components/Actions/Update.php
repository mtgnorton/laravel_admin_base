<?php

namespace App\Admin\Forms;

use App\Constants\SpiderConstant;
use App\Model\Config;
use App\Services\Gather\CrawlService;
use App\Services\OnlineUpdateService;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class Update extends Base
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
        foreach ($data as $item) {

            if (version_compare(conf('update.version', '1.0.0'), $item['version'], '<')) {
                if (!$packURL = data_get($item, 'package')) {
                    admin_error('更新链接不存在,暂时无法更新');
                    return back();
                }
                $rs = OnlineUpdateService::update($packURL);

                if (!$rs['state']) {
                    admin_error($rs['status']);
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
                $totalFileAmount += $rs['amount'];
            }
        }


        admin_success(ll(sprintf('更新成功,共更新%s个文件', $totalFileAmount)));
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
    <label class="col-sm-2  control-label">点击更新<\/label>
    <div class="col-sm-8">
        <div class="box box-solid box-default no-margin">

            <div class="box-body">
            <button  class="btn btn-info">系统更新</button>
            <\/div>
        <\/div>
    <\/div>
<\/div>`

$('.fields-group').append(h)

HTML;


        if (version_compare(conf('update.version', '1.0.0'), $version, '<')) {
            $this->display('version', '当前版本');
            $this->display('desc', '版本描述');

            Admin::script($html);
        } else {
            $this->display('version', '当前版本');
            $this->display('desc', '版本描述');
            $this->display('t', '版本更新')->with(function ($value) {
                return '已是最新版本';
            });

        }

        $this->disableReset();

        $this->disableSubmit();


    }
}

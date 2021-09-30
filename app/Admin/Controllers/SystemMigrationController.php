<?php

namespace App\Admin\Controllers;


use App\Admin\Components\Renders\DynamicOutput;
use App\Http\Controllers\Controller;
use App\Model\Test;
use App\Service\DatabaseService;
use App\Service\FileService;
use App\Service\ImportAndExportService;
use App\Service\ZipService;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Illuminate\Support\Facades\Request;
use Encore\Admin\Controllers\AdminController;

class SystemMigrationController extends AdminController
{


    public function export()
    {
        if (request()->isMethod('GET')) {

            $form = new Form(new Test());

            $form->display('t', '导出提示')->with(function () {
                return '系统将会把部分文件和数据库数据导出到压缩包文件中,将会通过浏览器下载到本地';
            });
            $form->setAction('/admin/migration-export');
            return DynamicOutput::get($form);

        }

        DynamicOutput::post();
        force_notify('开始执行数据表的导出');
        ImportAndExportService::export();
        force_notify('文件压缩完成');


        force_notify('<a href="/admin/migration-download"> 点击下载</a>', '提示', 'info');


    }


    public function download()
    {
        return response()->download(public_path('seo/migration.zip'));
    }

    public function serverDownload()
    {
        if (!is_file(public_path('seo_php.tar.gz'))) {
            return '迁移文件不存在,请先生成迁移文件';
        }

        return response()->download(public_path('seo_php.tar.gz'));

    }

    public function import()
    {


        if (request()->isMethod('GET')) {
            $form = new Form(new Test());


            force_response('<style>.file-drop-zone{height:60%!important;}</style>');
            $form->file('file', '上传文件');

            $form->setAction('/admin/migration-import');
            return DynamicOutput::get($form);

        }
        DynamicOutput::post();

        $file = \request()->file('file');

        if ($file->extension() != 'zip') {
            force_notify('文件上传类型不正确,请关闭后重新上传', '提示', 'error');
            exit;
        }

        ImportAndExportService::import($file);

    }
}

<?php

namespace App\Admin\Components\Settings;


use App\Admin\Components\Renders\DynamicOutput;
use App\Service\ImportAndExportService;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class SystemMigration extends Base
{
    public function tabTitle()
    {
        return '后台系统迁移';
    }

    public function handle(Request $request)
    {

        ImportAndExportService::import($request->file('import'));
        admin_success(ll(sprintf('更新成功,共更新%s个文件,共更新%s个sql', 1, 1)));
        return back();
    }


    /**views\admin\widgets
     * Build a form here.
     */
    public function form()
    {


        Admin::style('
        .pull-left{display:none;}
        ');

        DynamicOutput::modalRender("导入", '点击导入', '系统数据导入', '/admin/migration-import');
        DynamicOutput::modalRender("导出", '点击导出', '系统数据导出', '/admin/migration-export');

    }
}

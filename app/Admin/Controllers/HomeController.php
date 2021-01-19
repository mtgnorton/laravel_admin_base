<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Block;
use App\Model\Collect;
use App\Model\Network;
use App\Model\Project;
use App\Model\UserAddress;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Grid\Displayers\Label;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Table;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('首页')
            ->description('统计信息')
            ->row(function (Row $row) {
                $row->column(2, function (Column $column) {

                });

            });
    }
}

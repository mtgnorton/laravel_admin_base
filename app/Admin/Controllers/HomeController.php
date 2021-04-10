<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;

use App\Model\User;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index(Content $content)
    {
//        app('SmsService')->sendGeneral(18063164161, Message::Type['HELLO_WORLD']);
        return $content
            ->title('首页')
            ->description('统计信息')
            ->row(function (Row $row) {

                $row->column(2, function (Column $column) {
                    $infoBox = new InfoBox('今日新增会员数量', '', 'red', '/admin/users', User::where('created_at', Carbon::now()->startOfDay())->count());

                    $column->append($infoBox);
                });
                $row->column(2, function (Column $column) {
                    $infoBox = new InfoBox('会员总数量', '', 'red', '/admin/users', User::count());

                    $column->append($infoBox);
                });

            });
    }
}

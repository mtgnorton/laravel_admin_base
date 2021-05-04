<?php

namespace App\Admin\Components\Settings;

use App\Model\Config;
use App\Model\Symbol;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class Developer extends Base
{

    public function tabTitle()
    {
        return ll('Developer setting');
    }

    /**
     * Build a form here.
     */
    public function form()
    {

        $this->number('time_offset_day', ll('时间偏移天数'))->default(0);
        $this->number('time_offset_hour', ll('时间偏移小时数'))->default(0);
        $this->display('now_time', ll('当前时间'))->with(function () {
            return system_time(1);
        });

        $this->text('h5_register_link', ll('网页注册链接'))->default('/register_h5#/?invite_code={username}&download_ios_link={download_ios_link}&download_android_link={download_android_link}')->help('{}中的内容不可修改和删除');
    }


}

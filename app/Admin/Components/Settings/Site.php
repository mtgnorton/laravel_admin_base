<?php

namespace App\Admin\Components\Settings;

use App\Model\Config;
use App\Model\Symbol;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class Site extends Base
{


    /**
     * Build a form here.
     */
    public function form()
    {

        $this->text('site_name', ll("Site name"))->rules('required');
        $this->switch('is_close_site', '站点状态')->states([
            'on'  => ['value' => 'on', 'text' => '关闭', 'color' => 'danger'],
            'off' => ['value' => 'off', 'text' => '开启', 'color' => 'success']
        ]);
        $this->text('close_site_reason', '关站原因');

        $this->radio('open_front_log', '前台日志')->options([
            1 => '开启',
            0 => '关闭',
        ]);

    }


    public function tabTitle()
    {
        return ll('Site setting');
    }
}

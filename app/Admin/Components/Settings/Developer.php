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

        $this->textarea('restart_go_command', ll('restart go command'));
    }


}

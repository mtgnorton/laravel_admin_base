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
    }


    public function tabTitle()
    {
        return ll('Site setting');
    }
}

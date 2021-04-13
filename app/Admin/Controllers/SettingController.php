<?php

namespace App\Admin\Controllers;

use App\Admin\Components\Settings\Developer;
use App\Admin\Components\Settings\Site;
use App\Admin\Components\Settings\Other;
use App\Admin\Components\Settings\Sms;
use App\Admin\Components\Settings\SmsTemplate;
use App\Admin\Components\Settings\Storage;
use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index(Content $content)
    {
        $forms = [
            'basic'       => Site::class,
            'other'       => Other::class,
            'sms'         => Sms::class,
            'smsTemplate' => SmsTemplate::class,
            'storage'     => Storage::class,

        ];


        Admin::script(app('DeveloperService')->toBeJs());

        return $content
            ->title('系统设置')
            ->body(Tab::forms($forms));
    }

    public function openDeveloper()
    {
        app('DeveloperService')->toBeDeveloper();
        return $this->transfer();
    }

}

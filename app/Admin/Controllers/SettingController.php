<?php

namespace App\Admin\Controllers;

use App\Admin\Components\Settings\Site;
use App\Admin\Components\Settings\Other;
use App\Http\Controllers\Controller;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Layout\Content;

class SettingController extends Controller
{
    public function index(Content $content)
    {
        $forms = [
            'basic' => Site::class,
            'other' => Other::class,
        ];

        return $content
            ->title('系统设置')
            ->body(Tab::forms($forms));
    }
}

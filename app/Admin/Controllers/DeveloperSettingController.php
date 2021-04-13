<?php

namespace App\Admin\Controllers;

use App\Admin\Components\Settings\Developer;

use App\Http\Controllers\Controller;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Layout\Content;


class DeveloperSettingController extends Controller
{
    public function index(Content $content)
    {
        $forms = [
            'developer' => Developer::class,
        ];
        return $content
            ->title(ll('Global config'))
            ->body(Tab::forms($forms));
    }


}

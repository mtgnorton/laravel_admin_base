<?php

namespace App\Admin\Controllers;


use App\Admin\Components\Steps\Authorization;

use App\Admin\Components\Steps\Business;
use App\Admin\Components\Steps\Database;
use App\Http\Controllers\Controller;
use Encore\Admin\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\MultipleSteps;
use Illuminate\Support\Facades\Auth;

class InstallController extends Controller
{
    public function index(Content $content)
    {

        $userModel = config('admin.database.users_model');
        Auth::setUser(new $userModel());

        $style = <<<EOT
.main-header{
   display:none;
}
.main-sidebar{
   display:none;
}
.content-wrapper{
margin:0px;
}
.breadcrumb{
   display:none;
}

EOT;
        Admin::style($style);


        $steps = [
            'authorization' => Authorization::class,
            'database'      => Database::class,
            'Business'      => Business::class,

        ];

        return $content
            ->title('安装')
            ->body(MultipleSteps::make($steps));
    }
}

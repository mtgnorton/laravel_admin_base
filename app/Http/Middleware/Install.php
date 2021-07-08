<?php

namespace App\Http\Middleware;


use Closure;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Install
{

    public function handle(Request $request, Closure $next)
    {


        if (!in_array(\request()->path(), [
                'admin/install',
                'admin/_handle_form_'
            ]) && !conf('auth.code')) {
            return redirect()->to('/admin/install');
        }


        if ( //进行安装时,由于未登录会被laravel-admin自带的Authenticate中间件进行重定向,索引在该中间件之前给一个默认的空用户
            $request->is('*_handle_form_*') &&
            Admin::guard()->guest() &&
            in_array(\request()->_form_, [
                'App\Admin\Components\Steps\Authorization',
                'App\Admin\Components\Steps\Database',
                'App\Admin\Components\Steps\Business'
            ])
        ) {
            $userModel = config('admin.database.users_model');
            Admin::guard()->setUser(new $userModel());

        }

        return $next($request);
    }

}

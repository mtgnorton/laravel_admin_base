<?php

namespace App\Admin\Components\Steps;


use Encore\Admin\Widgets\StepForm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Business extends StepForm
{
    /**
     * The form title.
     *
     * @var  string
     */
    public $title = '请填写相关信息';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {

        modify_env([
            'APP_URL' => rtrim($request->APP_URL, '/')
        ]);

        $userModel = config('admin.database.users_model');

        /**
         * @var $user Model
         */
        $user = new $userModel([
            'username' => $request->username,
            'name'     => $request->username,
            'password' => \Hash::make($request->password)
        ]);

        $user->save();
        $user->roles()->attach(1);
        $redirectTo = admin_base_path(config('admin.auth.redirect_to', 'auth/login'));

        return redirect()->to($redirectTo);
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->url('APP_URL', '该项目域名')
            ->default('http://seo.local/')
            ->help('如http://www.baidu.com')
            ->required();
        $this->text('username', '后台用户名')->default('admin')->required();
        $this->password('password', '后台密码')->rules('required|min:6|confirmed');
        $this->password('password_confirmation', '确认后台密码')->rules('required|min:6');

    }
}

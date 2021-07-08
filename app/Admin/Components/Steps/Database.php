<?php

namespace App\Admin\Components\Steps;


use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class Database extends StepForm
{
    /**
     * The form title.
     *
     * @var  string
     */
    public $title = '请填写数据库信息';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        modify_env($request->all());


        $this->createDatabase($request->DB_HOST, $request->DB_PORT, $request->DB_DATABASE, $request->DB_USERNAME, $request->DB_PASSWORD);

        DB::reconnect('mysql');

        Artisan::call('admin:install');

        Artisan::call('db:seed');




        return $this->next($request->all());

    }

    public function createDatabase($host, $port, $database, $username, $password)
    {
        try {
            $link = mysqli_connect($host, $username, $password, null, $port);


        } catch (\Exception $e) {
            throw new \Exception("数据库信息错误,无法连接数据库,具体的错误如下:" . $e->getMessage());
        }

        mysqli_query($link, "CREATE DATABASE " . $database);

        mysqli_close($link);

    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->text('DB_HOST', '数据库地址')->default('127.0.0.1')->required();
        $this->text('DB_PORT', '数据库端口')->default('3306')->required();
        $this->text('DB_DATABASE', '数据库名')->default('seo_aa')->required();
        $this->text('DB_USERNAME', '数据库用户名')->default('root')->required();
        $this->text('DB_PASSWORD', '数据库密码')->default('root')->required();
    }
}

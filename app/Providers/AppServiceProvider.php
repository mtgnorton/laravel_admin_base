<?php

namespace App\Providers;

use App\Service\UserService;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Monolog\Handler\RotatingFileHandler;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        bcscale(8);

        $this->recordSqlLog();
        $this->registerService();


    }

    public function recordSqlLog()
    {

        if (config('app.debug') == true) {
            DB::listen(function ($query) {
                $sql = str_replace("?", "'%s'", $query->sql);
                $log = "[{$query->time}ms] " . vsprintf($sql, $query->bindings);
                file_put_contents(storage_path('logs/sql.log'), $log.PHP_EOL, FILE_APPEND);
            });
        }

    }


    public function registerService()
    {
        $this->app->singleton('UserService', function ($app) {
            return new UserService();
        });

    }

}

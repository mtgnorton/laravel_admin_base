<?php

namespace App\Providers;

use App\Service\CrawlService;
use App\Service\DeveloperService;
use App\Service\Notification\HuanHuiService;
use App\Service\UserService;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
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
        $this->app->singleton('UserService', function ($app) {
            return new UserService();
        });
        $this->app->singleton('DeveloperService', function ($app) {
            return new DeveloperService();
        });
        $this->app->singleton('CrawlService', function ($app) {
            return new CrawlService();
        });
        $this->app->singleton('SmsService', function ($app) {

            /***
             * 根据配置使用不同的短信服务
             */
            return new HuanHuiService();
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \bcscale(8);

        $this->recordSqlLog();


    }

    public function recordSqlLog()
    {

        if (config('app.debug') == true) {
            DB::listen(function ($query) {
                $sql       = str_replace("?", "'%s'", $query->sql);
                $processID = getmypid();
                $log       = "[进程:$processID][{$query->time}ms] " . vsprintf($sql, $query->bindings);
                if (Str::contains($log, 'admin_permissions') || Str::contains($log, 'admin_roles') || Str::contains($log, 'admin_operation_log') || Str::contains($log, 'admin_users')) {
                    return;
                }

                sql_log($log);
            });
        }


    }


}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        if (Str::contains(request()->path(), 'redis')) {

            config([
                "database.redis.client" => 'predis'
            ]);
        }

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        config([
            'filesystems.default'                    => conf('storage_type', 'storage'),
            'admin.upload.disk'                      => conf('storage_type', 'storage'),
            'filesystems.disks.ali_cloud.access_id'  => conf('access_id', 'storage'),
            'filesystems.disks.ali_cloud.access_key' => conf('access_key', 'storage'),
            'filesystems.disks.ali_cloud.bucket'     => conf('bucket', 'storage'),
            'filesystems.disks.ali_cloud.endpoint'   => conf('endpoint', 'storage'),
        ]);
    }
}

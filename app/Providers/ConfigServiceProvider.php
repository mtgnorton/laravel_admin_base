<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {


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

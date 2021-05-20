<?php

namespace App\Providers;

use App\Model\Config;
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

        $configs = conf(['storage_type', 'access_id', 'access_key', 'bucket', 'endpoint', 'site_name']);

        config([
            'filesystems.default'                    => data_get($configs, 'storage_type'),
            'admin.upload.disk'                      => data_get($configs, 'storage_type'),
            'filesystems.disks.ali_cloud.access_id'  => data_get($configs, 'access_id'),
            'filesystems.disks.ali_cloud.access_key' => data_get($configs, 'access_key'),
            'filesystems.disks.ali_cloud.bucket'     => data_get($configs, 'bucket'),
            'filesystems.disks.ali_cloud.endpoint'   => data_get($configs, 'endpoint'),

            'admin.title'     => data_get($configs, 'site_name'),
            'admin.name'      => data_get($configs, 'site_name'),
            'admin.logo'      => data_get($configs, 'site_name'),
            'admin.logo-mini' => data_get($configs, 'site_name')
        ]);


    }
}

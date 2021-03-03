<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Model\AppVersion
 *
 * @property int $id
 * @property string $version_prefix 版本前缀
 * @property int $max_version 大版本号
 * @property int $min_version 小版本号
 * @property string $title 升级标题
 * @property string $description 升级描述
 * @property string $download_url 下载链接
 * @property int $client_type 0 安卓,1 ios
 * @property int $upgrade_type 2强制升级 1提醒升级  0不提醒升级
 * @property \Illuminate\Support\Carbon $created_at 创建时间
 * @property \Illuminate\Support\Carbon $updated_at 更新时间
 * @method static \Illuminate\Database\Eloquent\Builder|AppVersion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AppVersion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AppVersion query()
 * @method static \Illuminate\Database\Eloquent\Builder|AppVersion whereClientType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppVersion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppVersion whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppVersion whereDownloadUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppVersion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppVersion whereMaxVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppVersion whereMinVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppVersion whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppVersion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppVersion whereUpgradeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AppVersion whereVersionPrefix($value)
 * @mixin \Eloquent
 */
class AppVersion extends Model
{
    const CLIENT_TYPE = [
        'ANDROID' => 0,
        'IOS'     => 1
    ];
    const UPGRADE_TYPE = [
        'NO REMIND' => 0, //不提醒升级
        'REMIND'    => 1, //提醒升级
        'FORCE'     => 2, //强制升级
    ];


    /**
     * author: mtg
     * time: 2021/3/2   14:54
     * function description: 传出的版本是否是当前客户端的最大版本
     * @param string $clientType 客户端类型
     * @param string $clientVersion 客户端版本号
     * @return bool
     */
    static public function isMaxVersion(string $clientType, string $clientVersion, $exceptID = 0): bool
    {
        return static
            ::where('client_type', $clientType)
            ->whereNotIn('id', [$exceptID])
            ->pluck('version')->every(function ($value) use ($clientVersion) {

                return version_compare($value, $clientVersion, '<');

            });
    }


    /**
     * author: mtg
     * time: 2021/3/2   15:03
     * function description:获取当前客户端类型的最大版本
     * @param string $clientType
     */
    static public function getMaxVersion(string $clientType)
    {
        return static::where('client_type', $clientType)->orderByDesc('created_at')->first();
    }
}

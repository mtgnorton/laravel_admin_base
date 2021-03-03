<?php

namespace App\Service;

use App\Events\OrderEvent;
use App\Model\AppVersion;
use App\Model\Exchange;
use App\Model\ExchangeOrder;
use App\Model\Symbol;
use App\Model\TestFrozen;
use App\Model\User;
use App\Model\Wallet;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/*杂项服务*/

class MiscService
{


    /**
     * author: mtg
     * time: 2021/3/2   15:17
     * function description: 是否需要升级
     * @param string $clientType
     * @param string $clientVersion
     * @return array|int[]
     */
    public function version(string $clientType, string $clientVersion)
    {
        if (!in_array($clientType, AppVersion::CLIENT_TYPE)) {
            new_api_exception(ll('client type not exist'));
        }
        $rs    = [
            'has_new_version' => 0,
        ];
        $isMax = AppVersion::isMaxVersion($clientType, $clientVersion);

        if ($isMax) {
            return $rs;
        }
        $maxVersion = AppVersion::getMaxVersion($clientType);
        $rs         = [
            'has_new_version' => 1,
        ];
        return array_merge($rs, $maxVersion->only(['title', 'description', 'download_url', 'upgrade_type', 'version']));

    }

}

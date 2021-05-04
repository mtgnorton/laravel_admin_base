<?php

namespace App\Service;

use App\Events\OrderEvent;
use App\Model\Exchange;
use App\Model\ExchangeOrder;
use App\Model\Order;
use App\Model\Symbol;
use App\Model\TestFrozen;
use App\Model\User;
use App\Model\Wallet;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Encore\Admin\Auth\Database\Menu;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/*开发者模式*/

class DeveloperService
{
    /**
     * author: mtg
     * time: 2021/4/13   11:22
     * function description:是否是开发者模式
     * @return bool
     */
    public function isDeveloper()
    {
        return !!Session::get('open_developer');
    }


    public function toBeDeveloper()
    {
        Session::put('open_developer', 1);
    }


    /**
     * author: mtg
     * time: 2021/4/13   11:50
     * function description:开发者菜单
     * @return array[]
     */
    public function menus()
    {
        $menus = [
            [
                'id'         => 1000,
                'parent_id'  => 0,
                'order'      => 1000,
                'title'      => '开发者管理',
                'icon'       => 'fa-user-secret',
                'uri'        => '/',
                'permission' => null,
                'created_at' => '2021-03-25 09:18:24',
                'updated_at' => '2021-03-25 09:18:24',
                'ROOT'       => 1000,
                'roles'      => []
            ],
            [
                'id'         => 1001,
                'parent_id'  => 1000,
                'order'      => 1001,
                'title'      => 'redis管理',
                'icon'       => 'fa-database',
                'uri'        => '/redis',
                'permission' => null,
                'created_at' => '2021-03-25 09:18:24',
                'updated_at' => '2021-03-25 09:18:24',
                'ROOT'       => 1001,
                'roles'      => []
            ],
            [
                'id'         => 1006,
                'parent_id'  => 1000,
                'order'      => 1006,
                'title'      => '日志管理',
                'icon'       => 'fa-database',
                'uri'        => '/media',
                'permission' => null,
                'created_at' => '2021-03-25 09:18:24',
                'updated_at' => '2021-03-25 09:18:24',
                'ROOT'       => 1006,
                'roles'      => []
            ],
            [
                'id'         => 1002,
                'parent_id'  => 1000,
                'order'      => 1002,
                'title'      => '开发者配置',
                'icon'       => 'fa-database',
                'uri'        => '/developer_settings',
                'permission' => null,
                'created_at' => '2021-03-25 09:18:24',
                'updated_at' => '2021-03-25 09:18:24',
                'ROOT'       => 1002,
                'roles'      => []
            ],
            [
                'id'         => 1003,
                'parent_id'  => 1000,
                'order'      => 1003,
                'title'      => '开发者命令',
                'icon'       => 'fa-database',
                'uri'        => '/developer_commands',
                'permission' => null,
                'created_at' => '2021-03-25 09:18:24',
                'updated_at' => '2021-03-25 09:18:24',
                'ROOT'       => 1003,
                'roles'      => []
            ]
        ];
        return $menus;
    }

    public function toBeJs()
    {

        $script = <<<EOT

    function multiClickEvent(n,dom,fn) {
        dom.removeEventListener('dblclick',null);
        var n = parseInt(n) < 1 ? 1:parseInt(n),
            count = 0,
            lastTime = 0;//用于记录上次结束的时间
        var handler = function (event) {
            var currentTime = new Date().getTime();//获取本次点击的时间
            count = (currentTime-lastTime) < 300 ? count +1 : 0;//如果本次点击的时间和上次结束时间相比大于300毫秒就把count置0
            lastTime = new Date().getTime();
            if(count>=n-1){
                fn(event,n);
                count = 0;
            }
        };
        dom.addEventListener('click',handler);
    }

    var btn =document.getElementsByTagName("h1")[0]

    multiClickEvent(4,btn,function (event,n) {
       $.post("open_developer",function(data,status){
        window.location.reload()
    });
    })



EOT;
        return $script;

    }
}

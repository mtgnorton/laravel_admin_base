<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /*地址验证*/
        Validator::extend('ethAddress', function ($attribute, $value, $parameters, $validator) {
            if (!(preg_match('/^(0x)?[0-9a-fA-F]{40}$/', $value))) {
                return false; //满足if代表地址不合法
            }
            return true;
        });
        /*手机号验证*/
        Validator::extend('mobile', function ($attribute, $value, $parameters, $validator) {
            if (!(preg_match('/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\d{8}$/', $value))) {
                return false; //满足if代表地址不合法
            }
            return true;
        });

        /*短信验证码验证*/
        Validator::extend('auth_code', function ($attribute, $value, $parameters, $validator) {

            return app('SmsService')->validateAuthCode($parameters[0], $value, $parameters[1]);
        });


        /*版本号验证*/
        //  要求，必须是三位，x.x.x的形式，
        // 每位x的范围分别为1-99,0-99,0-99。
        // 不允许的情况0.x.x；01.x.x; x.0x.x; x.00.x； x.x.00; x.x.0x
        Validator::extend('version', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^([1-9]\d|[1-9])(\.([1-9]\d|\d)){2}$/', $value);
        });

    }
}

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(
    [
        'prefix'     => 'v1',
        'middleware' => ['cors', 'close.site',]
    ],
    function () {
        Route::any("/user_register", "UserController@register");
        Route::any("/user_login", "UserController@login");

        Route::post("/user_logout", "UserController@logout");

        Route::post('user_forget_password', 'UserController@forgetPassword');


        Route::get('sms_get_code', 'MiscController@SmsCode');
        Route::post('misc_uploads', 'MiscController@uploads'); //通用上传接口


        Route::middleware(['api.refresh', 'judge.user.disabled'])->group(function () {

            //杂项接口
            Route::get('misc_advert_list', 'MiscController@advertList');//广告列表
            Route::get('misc_announcement_list', 'MiscController@announcementList');//公告列表
            Route::get('misc_announcement_detail', 'MiscController@announcementDetail');//公告详情


            Route::apiResource('posts', 'PostController');
            Route::get('user_info', 'UserController@info');
            Route::any('user_set_pay_password', 'UserController@setPayPassword');//设置或修改支付密码
            Route::post('user_logout', 'UserController@logout');//退出登录

        });
    });

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
        'middleware' => ['cors']
    ],
    function () {
        Route::any("/user_register", "UserController@register");
        Route::any("/user_login", "UserController@login");

        Route::get('sms_get_code', 'MiscController@SmsCode');

        Route::middleware('api.refresh')->group(function () {

            //杂项接口
            Route::get('misc_advert_list', 'MiscController@advertList');
            Route::get('misc_announcement_list', 'MiscController@announcementList');
            Route::get('misc_announcement_detail', 'MiscController@announcementDetail');


            Route::get('user_info', 'UserController@info');
        });
    });

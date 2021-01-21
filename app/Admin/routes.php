<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
    'as'         => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->post('upload', 'CommonController@upload');

    $router->resources([
        'users'    => 'UserController',
        'posts'    => 'PostController',
        'comments' => 'CommentController',
    ]);
    $router->get('backups', 'BackupController@index');
    $router->delete('backups/{id}', 'BackupController@destroy');
    $router->any('settings', 'SettingController@index');

});

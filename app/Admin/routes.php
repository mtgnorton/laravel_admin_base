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


    $router->resources([
        'users'    => 'UserController',
        'posts'    => 'PostController',
        'comments' => 'CommentController',
    ]);
    $router->resource('certifications', 'CertificationController');
    $router->get('backups', 'BackupController@index');
    $router->delete('backups/{id}', 'BackupController@destroy');
    $router->any('settings', 'SettingController@index');

    $router->any('developer_commands', 'DeveloperCommandController@index');

    $router->resource('advert_categories', 'AdvertCategoryController');
    $router->resource('adverts', 'AdvertController');
    $router->resource('announcements', 'AnnouncementController');
    $router->resource('document_categories', 'DocumentCategoryController');
    $router->resource('documents', 'DocumentController');
    $router->resource('app_versions', 'AppVersionController');

    $router->post('upload', 'CommonController@upload');


    $router->post('open_developer', 'SettingController@openDeveloper');
    $router->any('developer_settings', 'DeveloperSettingController@index');
    $router->resource('logs', 'LogController');
});

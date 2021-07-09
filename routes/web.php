<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/sf', function () {

    return view('sf');
});

Route::post('/sf-save', function () {

    \App\Model\Position::create([
        't1' => request()->t1,
        't2' => request()->t2,
    ]);
    common_log('', request()->all());
});



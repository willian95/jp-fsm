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
    return view('login');
});

Route::post('/login', 'LoginController@login')->name('login');

Route::group(['prefix' => 'dashboard'], function(){

    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::group(['prefix' => 'asset_types'], function(){

        Route::get('/index', 'AssetsController@index')->name('dashboard.assets.index');
        Route::get('/create', 'AssetsController@create')->name('dashboard.assets.create');
        Route::post('/store', 'AssetsController@store')->name('dashboard.assets.store');

    });

});
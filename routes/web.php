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

    Route::group(['prefix' => 'partners'], function(){

        Route::get('/index', 'PartnersController@index')->name('dashboard.partners.index');
        Route::get('/get/all', 'PartnersController@getAll')->name('dashboard.partners.get.all');
        Route::get('/create', 'PartnersController@create')->name('dashboard.partners.create');
        Route::post('/store', 'PartnersController@store')->name('dashboard.partners.store');
        Route::get('/statesCovered/{id}', 'PartnersController@getStatesCovered')->name('dashboard.partners.statesCovered.get');

    });

});

Route::group(['prefix' => 'api'], function(){

	Route::get('/states/all', 'AddressesController@allStates');
	Route::get('/counties/all', 'AddressesController@allCounties');
	Route::get('/cities/all', 'AddressesController@allCities');

	Route::get('/counties/state_id/{id}', 'AddressesController@countyByStateId');
	Route::get('/cities/county_id/{id}', 'AddressesController@cityByCountyId');

});
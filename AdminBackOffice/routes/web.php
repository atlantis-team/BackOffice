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


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

/*Route::group(['middleware' => 'auth'], function () {*/
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/devices', 'DeviceController@index')->name('devices');
    Route::get('/devices/all', 'DeviceController@getDevices')->name('devices.all');
    Route::post('/devices/add_user', 'DeviceController@addUser')->name('devices.add.user');
    Route::post('/devices/remove_user', 'DeviceController@removeUser')->name('devices.remove.user');

    Route::get('/user-autocomplete-ajax', 'UserController@dataAjax')->name('users.ajax');
/*});*/

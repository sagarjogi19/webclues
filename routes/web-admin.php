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
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    /* dashboard */
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('dashboard', 'HomeController@index')->name('dashboard');
    Route::get('get-dashboard-data', 'HomeController@getDashboardData')->name('get-dashboard-data');
   
    /* Car Resource */
    Route::resource('cars', 'CarController');
    /* View all car in map */
    Route::get('view-map', 'CarController@viewMap')->name('view-map');

});

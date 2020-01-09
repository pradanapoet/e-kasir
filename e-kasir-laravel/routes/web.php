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
    return view('home');
});

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin','AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');
// Route::get('/pemilik/dashboard', 'PemilikController@index');

// Hanya Pemilik
Route::group(['middleware' => ['auth','checkRole:pemilik']],function(){

    Route::get('/pemilik', 'PemilikController@index');

});


//Hanya Kasir
Route::group(['middleware' => ['auth','checkRole:kasir']],function(){

    Route::get('/kasir', 'KasirController@index');

});

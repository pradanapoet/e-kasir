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
    Route::get('/kategori_pemilik', 'PemilikController@kategori');
    Route::get('/listbarang_pemilik', 'PemilikController@listbarang');
    Route::get('/liststok_pemilik', 'PemilikController@liststok');
    Route::get('/lap_penjualan_pemilik', 'PemilikController@laporan_penjualan');
    Route::get('/lap_laba_pemilik', 'PemilikController@laporan_laba');
    Route::get('/lap_barang_pemilik', 'PemilikController@laporan_barang');
    Route::post('/tambah_kategori', 'PemilikController@tambah_kategori');
});


//Hanya Kasir
Route::group(['middleware' => ['auth','checkRole:kasir']],function(){

    Route::get('/kasir', 'KasirController@index');
    Route::get('/kategori_kasir', 'KasirController@kategori');
    Route::get('/listbarang_kasir', 'KasirController@listbarang');
    Route::get('/liststok_kasir', 'KasirController@liststok');
    Route::get('/lap_penjualan_kasir', 'KasirController@laporan_penjualan');
    Route::get('/lap_laba_kasir', 'KasirController@laporan_laba');
    Route::get('/lap_barang_kasir', 'KasirController@laporan_barang');

});

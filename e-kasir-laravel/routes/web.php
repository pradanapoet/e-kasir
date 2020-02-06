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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', 'AuthController@login')->name('login');
Route::post('/postlogin','AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');
// Route::get('/coba', 'StokController@coba');
// Route::get('/pemilik/dashboard', 'PemilikController@index');

// Hanya Pemilik
Route::group(['middleware' => ['auth','checkRole:pemilik']],function(){
    Route::get('/pemilik', 'PemilikController@index');
    Route::get('/kategori_pemilik', 'KategoriController@index');//read kategori
    Route::post('/tambah_kategori', 'KategoriController@tambah_kategori'); //tambah kategori
    Route::post('/kategori_pemilik/update', 'KategoriController@update'); // update kategori
    Route::post('/kategori_pemilik/hapus', 'KategoriController@destroy'); //Untuk Hapus Kategori
    Route::get('/listbarang_pemilik', 'BarangController@index');
    Route::post('/tambah_barang', 'BarangController@tambah_barang'); //tambah barang
    Route::post('/listbarang_pemilik/update', 'BarangController@update'); // update kategori
    Route::post('/listbarang_pemilik/hapus', 'BarangController@destroy'); //Untuk Hapus Kategori
    Route::get('/liststok_pemilik', 'StokController@index');
    Route::post('/tambah_stok', 'StokController@tambah_stok'); //tambah stok
    Route::post('/liststok_pemilik/update', 'StokController@update'); // update stok
    Route::get('/lap_penjualan_pemilik', 'PemilikController@laporan_penjualan');
        Route::get('/lap_penjualan_pemilik_print', 'PemilikController@laporan_penjualan_print');
    Route::post('/detail_lap_penjualan', 'PemilikController@detail_laporan_penjualan');
    Route::get('/lap_laba_pemilik', 'PemilikController@laporan_laba');
    Route::post('/lap_laba_pemilik_print_sorted', 'PemilikController@laporan_laba_print_sorted');
    Route::get('/lap_laba_pemilik_print', 'PemilikController@laporan_laba_print');
    Route::post('/lap_laba_pemilik', 'PemilikController@laporan_laba_sort');
    Route::get('/lap_barang_pemilik', 'PemilikController@laporan_barang');
        Route::get('/lap_barang_pemilik_print', 'PemilikController@laporan_barang_print');
    Route::get('/stok_kadaluarsa', 'PemilikController@kadaluarsa');
    Route::get('update-status/{id}', 'PemilikController@update_status');

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


//Kasir dan Pemilik
Route::group(['middleware' => ['auth','checkRole:kasir,pemilik']],function(){

    Route::get('/pos', 'POSController@index');
    Route::post('/pos/store', 'POSController@store');
    Route::get('/pos/store-selesai', 'POSController@store_selesai');
    Route::get('add-to-cart/{id}', 'POSController@addToCart');
    Route::get('remove-from-cart/{id}', 'POSController@remove');
    Route::post('/print-barcode', 'StokController@print_barcode');
});

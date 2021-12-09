<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::middleware('auth')->group(function(){
    Route::resource('/buku','BukuController')->middleware('privilege:admin');
    Route::get('/buku-search','BukuController@search')->name('buku.search')->middleware('privilege:admin');
    Route::resource('/anggota','AnggotaController')->middleware('privilege:admin');
    Route::get('/anggota-search','AnggotaController@search')->name('anggota.search')->middleware('privilege:admin');
    Route::resource('/transaksi','TransaksiController')->middleware('privilege:admin&user');
    Route::get('/transaksi-search','TransaksiController@search')->name('transaksi.search')->middleware('privilege:admin&user');
    Route::resource('/riwayat','HistoryController')->middleware('privilege:admin&user');
    Route::get('/all','HistoryController@showAll')->name('riwayat.all')->middleware('privilege:admin&user');
    Route::get('/laporan','LaporanController@index')->name('laporan.index')->middleware('privilege:admin&user');
    Route::get('/buku-pdf','LaporanController@bukuPdf')->name('buku.pdf')->middleware('privilege:admin&user');
    Route::get('/buku-excel','LaporanController@bukuExcel')->name('buku.excel')->middleware('privilege:admin&user');
    Route::get('/transaksi-pdf','LaporanController@transaksiPdf')->name('transaksi.pdf')->middleware('privilege:admin&user');
    Route::get('/transaksi-excel','LaporanController@transaksiExcel')->name('transaksi.excel')->middleware('privilege:admin&user');
    Route::resource('/petugas','PetugasController');
});

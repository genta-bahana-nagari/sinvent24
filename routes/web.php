<?php

use App\Http\Controllers\control_barang;
use App\Http\Controllers\control_dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\control_kategori;
use App\Http\Controllers\control_keluar;
use App\Http\Controllers\control_masuk;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('frontend.dashboard.index');
// });
Route::get('/', [control_dashboard::class, 'index'])->name('dashboard.index');
Route::resource('kategori', control_kategori::class);
Route::resource('barang', control_barang::class);
Route::resource('masuk', control_masuk::class);
Route::resource('keluar', control_keluar::class);
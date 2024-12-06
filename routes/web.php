<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

// Guest routes: hanya bisa diakses oleh user yang belum login (guest)
Route::middleware('guest')->group(function () {
    // Route untuk menampilkan halaman register
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    // Route untuk memproses data register
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    // Route untuk menampilkan halaman login (GET request)
    Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    // Route untuk memproses login (POST request)
    Route::post('/login', [LoginController::class, 'check_login'])->name('login.check_login');
});

// Route untuk logout (hanya bisa diakses oleh user yang login)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Group route untuk user yang sudah login (auth)
Route::middleware(['auth'])->group(function () {
    // Route ke dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('kategori', KategoriController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('barang-masuk', BarangMasukController::class);
    Route::resource('barang-keluar', BarangKeluarController::class);
});

<?php

use App\Http\Controllers\KartuController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
// use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::group(['prefix' => 'admin', 'middleware' => ['auth', isAdmin::class]], function () {
//     Route::get('/', function () {
//         return view('welcome');
//     });
//     // untuk Route Backend Lainnya
//     Route::resource('user', App\Http\Controllers\user::class);

// });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {
    Route::resource('kartu', KartuController::class);
    Route::resource('pemasukan', PemasukanController::class);
    Route::resource('pengeluaran', PengeluaranController::class);
});

<?php

use App\Http\Controllers\KartuController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\PemasukanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {
    Route::resource('kartu', KartuController::class);
    Route::resource('pemasukan', PemasukanController::class);
    Route::resource('keuangan', KeuanganController::class);
});

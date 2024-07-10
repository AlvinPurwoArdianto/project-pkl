<?php

use App\Http\Controllers\KartuController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Models\Kartu;
// use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $kartu = Kartu::all();
    return view('welcome', compact('kartu'));
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
    Route::resource('dompet', KartuController::class);
    Route::resource('pemasukan', PemasukanController::class);
    Route::resource('pengeluaran', PengeluaranController::class);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    // Route::resource('home', HomeController::class);
});

Route::get('profile', function () {
    return view('profile');
});

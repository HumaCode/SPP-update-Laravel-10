<?php

use App\Http\Controllers\BerandaOperatorController;
use App\Http\Controllers\BerandaWaliController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\KartuSppController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaliController;
use App\Http\Controllers\WaliSiswaController;
use App\Http\Controllers\KwitansiPembayaranController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




// operator
Route::prefix('operator')->middleware(['auth', 'auth.operator'])->group(function () {
    Route::get('beranda', [BerandaOperatorController::class, 'index'])->name('operator.beranda');

    Route::resource('user', UserController::class);
    Route::resource('wali', WaliController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('walisiswa', WaliSiswaController::class);
    Route::resource('biaya', BiayaController::class);
    Route::resource('tagihan', TagihanController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::get('kwitansi-pembayaran/{id}', [KwitansiPembayaranController::class, 'show'])->name('kwitansipembayaran.show');
    Route::get('kartu-spp', [KartuSppController::class, 'index'])->name('kartuspp.index');
});

// wali
Route::prefix('walimurid')->middleware(['auth', 'auth.wali'])->group(function () {
    Route::get('beranda', [BerandaWaliController::class, 'index'])->name('wali.beranda');
});

// admin
Route::prefix('admin')->middleware(['auth', 'auth.admin'])->group(function () {
    // admin
});


Route::get('logout', function () {
    Auth::logout();
    return redirect('login');
})->name('logout.user');

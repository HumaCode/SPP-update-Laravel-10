<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BankSekolahController;
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
use App\Http\Controllers\WaliMuridPembayaranController;
use App\Http\Controllers\WaliMuridSiswaController;
use App\Http\Controllers\WaliMuridTagihanController;
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

    Route::resource('banksekolah', BankSekolahController::class);
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

Route::get('login-wali-murid', [LoginController::class, 'showLoginFormWali'])->name('login.wali');


// wali
Route::prefix('walimurid')->middleware(['auth', 'auth.wali'])->name('wali.')->group(function () {
    Route::get('beranda', [BerandaWaliController::class, 'index'])->name('beranda');

    Route::resource('siswa', WaliMuridSiswaController::class);
    Route::resource('tagihan', WaliMuridTagihanController::class);
    Route::resource('pembayaran', WaliMuridPembayaranController::class);
});

// admin
Route::prefix('admin')->middleware(['auth', 'auth.admin'])->group(function () {
    // admin
});


Route::get('logout', function () {
    Auth::logout();
    return redirect('login');
})->name('logout.user');

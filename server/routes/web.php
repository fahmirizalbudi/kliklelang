<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LelangController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PetugasController;
use Illuminate\Support\Facades\Route;

define('INDEX_PATH', '/');

Route::prefix('auth')->group(function () {
  Route::prefix('login')->group(function () {
    Route::get('petugas', [AuthController::class, 'view_login'])->name('login.view.petugas');
    Route::get('masyarakat', [AuthController::class, 'view_login'])->name('login.view.masyarakat');
    Route::post('petugas', [AuthController::class, 'login_petugas'])->name('login.petugas');
    Route::post('masyarakat', [AuthController::class, 'login_masyarakat'])->name('login.masyarakat');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
  });
});

Route::prefix('dashboard')->group(function () {
  Route::get(INDEX_PATH, HomeController::class)->name('home');
  Route::resource('petugas', PetugasController::class)->except(['show'])->parameters([
    'petugas' => 'petugas'
  ]);
  Route::resource('barang', BarangController::class)->except('show');
  Route::resource('masyarakat', MasyarakatController::class)->except('show');
  Route::patch('masyarakat/{masyarakat}/block', [MasyarakatController::class, 'block'])->name('masyarakat.block');
  Route::patch('masyarakat/{masyarakat}/unblock', [MasyarakatController::class, 'unblock'])->name('masyarakat.unblock');
  Route::prefix('lelang')->group(function () {
    Route::get(INDEX_PATH, [LelangController::class, 'index'])->name('lelang.index');
    Route::get('activation', [LelangController::class, 'activation'])->name('lelang.activation');
    Route::post('activate', [LelangController::class, 'activate'])->name('lelang.activate');
    Route::patch('{lelang}/open', [LelangController::class, 'open'])->name('lelang.open');
    Route::patch('{lelang}/close', [LelangController::class, 'close'])->name('lelang.close');
    Route::delete('{lelang}', [LelangController::class, 'destroy'])->name('lelang.destroy');
  });
});
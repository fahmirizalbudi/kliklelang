<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PetugasController;
use Illuminate\Support\Facades\Route;

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
  Route::get('/', HomeController::class)->name('home');
  Route::resource('petugas', PetugasController::class)->except(['show'])->parameters([
    'petugas' => 'petugas'
  ]);
  Route::resource('barang', BarangController::class)->except('show');
  Route::resource('masyarakat', MasyarakatController::class)->except('show');
});
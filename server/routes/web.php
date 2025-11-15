<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
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

Route::prefix('petugas')->group(function () {
  Route::resource('barang', BarangController::class)->except('show');
});
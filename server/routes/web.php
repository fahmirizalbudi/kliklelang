<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HistoryLelangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
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
  })->middleware(['guest:petugas', 'guest:masyarakat']);
  Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth.any');
});

Route::prefix('dashboard')->middleware('auth:petugas')->group(function () {
  Route::get(INDEX_PATH, HomeController::class)->name('home');
  Route::resource('petugas', PetugasController::class)->except(['show'])->parameters([
    'petugas' => 'petugas'
  ]);
  Route::resource('barang', BarangController::class)->except('show');
  Route::resource('masyarakat', MasyarakatController::class)->except('show');
  Route::patch('masyarakat/{masyarakat}/block', [MasyarakatController::class, 'block'])->name('masyarakat.block');
  Route::patch('masyarakat/{masyarakat}/unblock', [MasyarakatController::class, 'unblock'])->name('masyarakat.unblock');
  Route::get('laporan/pemenang', [LaporanController::class, 'pemenang'])->name('laporan.pemenang');
  Route::get('laporan/pemenang/export', [LaporanController::class, 'pemenangExport'])->name('laporan.pemenang.export');
  Route::prefix('lelang')->group(function () {
    Route::get(INDEX_PATH, [LelangController::class, 'index'])->name('lelang.index');
    Route::get('{lelang}/detail', [LelangController::class, 'detail'])->name('lelang.detail');
    Route::get('activation', [LelangController::class, 'activation'])->name('lelang.activation');
    Route::get('histori', HistoryLelangController::class)->name('lelang.history');
    Route::post('activate', [LelangController::class, 'activate'])->name('lelang.activate');
    Route::patch('{lelang}/open', [LelangController::class, 'open'])->name('lelang.open');
    Route::patch('{lelang}/close', [LelangController::class, 'close'])->name('lelang.close');
    Route::delete('{lelang}', [LelangController::class, 'destroy'])->name('lelang.destroy');
  });
});

Route::middleware(['auth:masyarakat'])->group(function () {
  Route::get(INDEX_PATH, [AppController::class, 'index'])->name('app.index');
  Route::get('lelang', [AppController::class, 'lelang'])->name('app.lelang');
  Route::get('history', [AppController::class, 'history'])->name('app.history');
  Route::get('lelang/{lelang}/bid', [AppController::class, 'lelangBid'])->name('app.lelang.bid');
  Route::get('lelang/{lelang}/history', [AppController::class, 'lelangHistory'])->name('app.lelang.history');
  Route::post('lelang/{lelang}/bidding', [AppController::class, 'lelangBidding'])->name('app.lelang.bidding');
});
<?php

use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Api\LelangController as ApiLelangController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login/masyarakat', [ApiAuthController::class, 'loginMasyarakat']);
    Route::get('me/masyarakat', [ApiAuthController::class, 'me'])->middleware('api.masyarakat');
});

Route::get('lelang', [ApiLelangController::class, 'index'])->middleware('api.masyarakat');
Route::get('lelang/{lelang}/detail', [ApiLelangController::class, 'detail'])->middleware('api.masyarakat');
Route::post('lelang/{lelang}/bid', [ApiLelangController::class, 'bid'])->middleware('api.masyarakat');
Route::get('lelang/history', [ApiLelangController::class, 'history'])->middleware('api.masyarakat');
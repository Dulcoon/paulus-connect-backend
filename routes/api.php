<?php

use App\Http\Controllers\Api\ApiPengumumanGereja;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\WilayahController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Api\UserProfileController;

use App\Http\Controllers\Api\SakramenEventController;
use App\Http\Controllers\Api\PendaftarController;



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    
    Route::post('/user-profile', [UserProfileController::class, 'store']);
    Route::get('/user-profile', [UserProfileController::class, 'show']);

    // untuk mendapatkan data baptis-event yang aktif
    Route::get('/sakramen-events/active', [SakramenEventController::class, 'getActiveEvents']);

    // mendapatkan data default pendaftar
    Route::get('/pendaftars/default', [PendaftarController::class, 'getDefaultData']);
    // mendaftar baptis
    Route::post('/pendaftars/daftar', [PendaftarController::class, 'daftarSakramen']);

    Route::get('/pendaftars/check-registration', [PendaftarController::class, 'checkRegistration']);
    // handle pengumuman
    Route::get('/pengumuman', [ApiPengumumanGereja::class, 'index']);
    Route::get('/pengumuman/{id}', [ApiPengumumanGereja::class, 'show']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/wilayah', [WilayahController::class, 'index']);
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail']);

Route::post('/forgot-password/send-otp', [AuthController::class, 'sendOtp']);
Route::post('/forgot-password/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/forgot-password/reset', [AuthController::class, 'resetPassword'])->middleware('throttle:5,1');

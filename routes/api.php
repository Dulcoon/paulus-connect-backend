<?php

use App\Http\Controllers\Api\ApiPengumumanGereja;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PendaftarController;
use App\Http\Controllers\Api\SakramenEventController;
use App\Http\Controllers\Api\UserProfileController;
// use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Api\WilayahController;
use App\Http\Controllers\Api\FCMController;
use App\Http\Controllers\Api\KalenderLiturgiApiController;
use App\Http\Controllers\Api\textMisaApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    
    Route::post('/user-profile', [UserProfileController::class, 'store']);
    Route::get('/user-profile', [UserProfileController::class, 'show']);
    Route::put('/user-profile/update', [UserProfileController::class, 'update']);
    Route::delete('/user-profile', [UserProfileController::class, 'destroy']);


    // untuk mendapatkan data baptis-event yang aktif
    Route::get('/sakramen-events/active', [SakramenEventController::class, 'getActiveEvents']);

    // mendapatkan data default pendaftar
    Route::get('/pendaftars/default', [PendaftarController::class, 'getDefaultData']);
    Route::post('/pendaftars/daftar', [PendaftarController::class, 'daftarSakramen']);
    Route::get('/pendaftars/check-registration', [PendaftarController::class, 'checkRegistration']);
    
    
    // handle pengumuman
    Route::get('/pengumuman', [ApiPengumumanGereja::class, 'index']);
    Route::get('/pengumuman/{id}', [ApiPengumumanGereja::class, 'show']);
    
    // fcmtoken
    Route::post('/save-fcm-token', [FCMController::class, 'saveToken']);
    Route::post('/send-notification', [FCMController::class, 'sendNotification']);

    Route::get('/kalender-liturgi/by-date', [KalenderLiturgiApiController::class, 'showByDate']);
    
    Route::get('/text-misa', [textMisaApiController::class, 'index']);
});

Route::post('/auth/google', [AuthController::class, 'loginWithGoogle']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/wilayah', [WilayahController::class, 'index']);
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail']);

Route::post('/forgot-password/send-otp', [AuthController::class, 'sendOtp']);
Route::post('/forgot-password/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/forgot-password/reset', [AuthController::class, 'resetPassword'])->middleware('throttle:5,1');

Route::get('/pendaftars/{id}/download-pdf', [PendaftarController::class, 'downloadPdf'])->name('pendaftars.download-pdf');


// fcm token

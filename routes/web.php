<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KalenderLiturgiController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\pengumumanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SakramenEventController;
use App\Http\Controllers\textMisaController;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');;
    Route::get('/dashboard/download-report', [DashboardController::class, 'downloadReport'])->name('dashboard.download-report');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('sakramen-events', SakramenEventController::class);


    // kelola pendaftar
    Route::get('/pendaftars', [PendaftarController::class, 'index'])->name('pendaftars.index');
    Route::get('/pendaftars/{id}', [PendaftarController::class, 'show'])->name('pendaftars.show');
    Route::post('/pendaftars/{id}/update-status', [PendaftarController::class, 'updateStatus'])->name('pendaftars.update-status');

    Route::post('/pendaftars/{id}/tandai-selesai', [PendaftarController::class, 'tandaiSelesai'])->name('pendaftars.tandai-selesai');
    // kelola pengumuman

    Route::resource('pengumuman', pengumumanController::class);

    Route::resource('kalender-liturgi', KalenderLiturgiController::class);
    
    Route::resource('text-misa', textMisaController::class)->except(['edit', 'update', 'show']);

});





require __DIR__ . '/auth.php';

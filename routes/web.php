<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.post');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::resource('siswa', StudentController::class)->only(['index']);
    Route::get('/qr/{barcode}', [StudentController::class, 'showQR'])->name('student.qr');

    Route::get('/absensi/scan', [AttendanceController::class, 'scanPage'])->name('absensi.scan.page');
    Route::post('/absensi/scan', [AttendanceController::class, 'scanStore'])->name('absensi.scan');

    Route::get('/absensi/scan-camera', [AttendanceController::class, 'scanCamera'])->name('absensi.scan.camera.page');
    Route::post('/absensi/scan-camera', [AttendanceController::class, 'scanCameraStore'])->name('absensi.scan.camera');

    Route::get('/absensi', [AttendanceController::class, 'index'])->name('absensi.index');

    // Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
    Route::put('/users/{user}/reset-password', [UserController::class, 'updatePassword'])->name('users.update-password');
});

    // Route::get('/laporan', [ReportController::class, 'index'])->name('laporan.index');
// });

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.post');

    Route::middleware('guest')->group(function () {
        Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
    });

    Route::get('/forgot-password', [ResetPasswordController::class, 'showForgotForm'])->name('forgot.password');
    Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink'])->name('forgot.password.post');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('reset.password');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('reset.password.post');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');


    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::middleware('auth')->group(function () {
        // Route::get('/absensi/scan-camera', [StudentController::class, 'index'])->name('siswa.index');
        Route::get('/absensi/kartu-saya', [StudentController::class, 'myCard'])->name('student.mycard');

        Route::get('/absensi', [AttendanceController::class, 'index'])->name('absensi.index');
        Route::get('/absensi/scan-camera', [AttendanceController::class, 'scanCamera'])->name('absensi.scan.camera.page');
        Route::post('/absensi/scan-camera', [AttendanceController::class, 'scanCameraStore'])->name('absensi.scan.camera');
        Route::get('/monitoring', [AttendanceController::class, 'monitoring'])->name('monitoring');
    });

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
    Route::put('/users/{user}/reset-password', [UserController::class, 'updatePassword'])->name('users.update-password');
});

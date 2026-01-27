<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    });

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::resource('/siswa', StudentController::class)->only(['index']);
Route::get('/qr/{barcode}', [StudentController::class, 'showQR'])
    ->name('student.qr');
// Route::resource('/guru', TeacherController::class)->only(['index']);

Route::get('/absensi/scan', [AttendanceController::class, 'scanPage']);
Route::post('/absensi/scan', [AttendanceController::class, 'scanStore'])->name('absensi.scan');
Route::get('/absensi/scan-camera', [AttendanceController::class, 'scanCamera']);
Route::post('/absensi/scan-camera', [AttendanceController::class, 'scanCameraStore'])
    ->name('absensi.scan.camera');

Route::get('/absensi', [AttendanceController::class, 'index']);
// Route::get('/laporan', [ReportController::class,'index']);

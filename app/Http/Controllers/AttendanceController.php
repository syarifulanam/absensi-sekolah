<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // Halaman daftar absensi
    public function index()
    {
        $attendances = Attendance::with('student')->orderBy('date', 'desc')->get();
        return view('absensi.index', compact('attendances'));
    }

    // Halaman scan kamera
    public function scanCamera()
    {
        return view('absensi.scan-camera'); // buat view scan-camera.blade.php
    }

    // Proses simpan hasil scan kamera
    public function scanCameraStore(Request $request)
    {
        $request->validate([
            'barcode' => 'required|exists:students,barcode',
        ]);

        $student = Student::where('barcode', $request->barcode)->first();

        Attendance::create([
            'student_id' => $student->id,
            'date' => now()->toDateString(),
            'time' => now()->toTimeString(),
            'status' => 'hadir',
        ]);

        return redirect()->back()->with('success', 'Absensi berhasil!');
    }

    // Monitoring absensi (misal untuk guru/admin)
    public function monitoring()
    {
        $attendances = Attendance::with('student')->orderBy('date', 'desc')->get();
        return view('absensi.monitoring', compact('attendances')); // buat view monitoring.blade.php
    }
}

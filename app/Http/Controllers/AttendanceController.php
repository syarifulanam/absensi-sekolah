<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function scanPage()
    {
        $today = Attendance::whereDate('date', today())->with('student')->get();
        return view('attendance.scan', compact('today'));
    }

    public function scanStore(Request $request)
    {
        $student = Student::where('barcode', $request->barcode)->first();

        if (!$student) {
            return response()->json(['error' => 'Siswa tidak ditemukan']);
        }

        $exists = Attendance::where('student_id', $student->id)
            ->whereDate('date', today())
            ->exists();

        if ($exists) {
            return response()->json(['error' => 'Sudah absen hari ini']);
            Attendance::create([
                'student_id' => $student->id,
                'date' => today(),
                'time' => now()->format('H:i:s'),
                'status' => 'hadir'
            ]);

            return response()->json(['success' => true]);
        }
    }

    public function scanCamera()
    {
        return view('attendance.scan-camera');
    }

    public function scanCameraStore(Request $request)
    {
        $request->validate([
            'barcode' => 'required'
        ]);

        $student = Student::where('barcode', $request->barcode)->first();

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'QR tidak valid'
            ]);
        }

        $exists = Attendance::where('student_id', $student->id)
            ->whereDate('date', today())
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Siswa sudah absen hari ini'
            ]);
        }

        Attendance::create([
            'student_id' => $student->id,
            'date' => today(),
            'time' => now()->format('H:i:s'),
            'status' => 'hadir'
        ]);

        return response()->json([
            'success' => true,
            'name' => $student->name,
            'class' => $student->class
        ]);
    }
}

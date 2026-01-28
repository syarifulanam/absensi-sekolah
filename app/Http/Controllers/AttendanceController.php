<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', auth()->id())->first();

        if (!$student) {
            return view('attendance.index', ['attendances' => collect()]);
        }

        $attendances = Attendance::with('student')
            ->where('student_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('attendance.index', compact('attendances'));
    }

    public function scanCamera()
    {
        return view('attendance.scan-camera');
    }


    public function scanCameraStore(Request $request)
    {
        $request->validate([
            'barcode' => 'required',
        ]);

        $student = Student::where('user_id', auth()->id())->first();

        if (!$student) {
            return back()->withErrors('Student data not found for this user.');
        }

        Attendance::create([
            'student_id' => $student->id,
            'barcode'    => $request->barcode,
            'status'     => 'hadir',
            'date'       => now()->toDateString(),
            'time'       => now()->toTimeString(),
        ]);

        return back()->with('success', 'Attendance recorded');
    }


    public function monitoring()
    {
        $attendances = Attendance::with('student')->latest()->take(50)->get();

        return view('attendance.monitoring', compact('attendances'));
    }

    public function monitoringData()
    {
        $attendances = Attendance::latest()->take(50)->get();
        return response()->json($attendances);
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'barcode' => 'required|string',
        ]);

        $attendance->update([
            'barcode' => $request->barcode
        ]);

        return response()->json(['success' => true, 'message' => 'Attendance updated']);
    }

    public function report()
    {
        $attendances = Attendance::latest()->take(50)->get();
        return view('reports.index', compact('attendances'));
    }
}

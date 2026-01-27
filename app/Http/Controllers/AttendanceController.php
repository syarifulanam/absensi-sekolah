<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('student')->orderBy('date', 'desc')->get();
        return view('attendance.index', compact('attendances'));
    }

    public function scanCamera()
    {
        return view('students.scan-camera');
    }


    public function scanCameraStore(Request $request)
    {
        $request->validate([
            'barcode' => 'required|string',
        ]);

        Attendance::create([
            'barcode' => $request->barcode,
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Attendance recorded: ' . $request->barcode);
    }


    public function monitoring()
    {
        return view('attendance.monitoring');
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
}

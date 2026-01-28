<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function myCard()
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();
        return view('student.my-card', compact('student'));
    }

    public function attendance()
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        $attendances = Attendance::where('student_id', $student->id)
            ->latest()
            ->get();

        return view('student.attendance', compact('student', 'attendances'));
    }
}

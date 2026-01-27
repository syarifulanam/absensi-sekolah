<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $students_count = Student::count();
        $teachers_count = User::where('role', 'guru')->count();
        $attendance_today = Attendance::whereDate('created_at', now())->count();

        return view('dashboard.index', compact('students_count', 'teachers_count', 'attendance_today'));
    }
}

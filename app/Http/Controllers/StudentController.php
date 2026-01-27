<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function showQR($barcode)
    {
        $student = Student::where('barcode', $barcode)->firstOrFail();
        return view('students.qr', compact('student'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\BarcodeGeneratorHTML;

class StudentController extends Controller
{

    public function showQR($barcode)
    {
        $student = Student::where('barcode', $barcode)->firstOrFail();
        return view('students.scan', compact('student'));
    }

    public function myCard()
    {
        $student = auth()->user();

        $generator = new BarcodeGeneratorPNG();
        $barcodeData = $generator->getBarcode($student->id, $generator::TYPE_CODE_128);
        $barcodeBase64 = base64_encode($barcodeData);

        return view('students.mycard', [
            'student' => $student,
            'barcode' => $barcodeBase64,
        ]);
    }

    public function scanPage()
    {
        return view('student.scan');
    }

    public function scanStore(Request $request)
    {
        $request->validate([
            'barcode' => 'required|string',
        ]);

        $student = auth()->user();

        Attendance::create([
            'student_id' => $student->id,
            'date'       => now()->format('Y-m-d'),
            'time'       => now()->format('H:i:s'),
            'status'     => 'hadir',
            'date' => now(),
        ]);

        return redirect()->back()->with('success', 'Absensi berhasil tercatat!');
    }
}

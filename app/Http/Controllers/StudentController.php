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

    public function scanCamera()
    {
        return view('student.scan-camera');
    }


    public function scanPage()
    {
        return view('students.scan');
    }

    public function scanCameraStore(Request $request)
    {
        $barcode = $request->barcode;
        return redirect()->back()->with('success', 'Attendance recorded: ' . $barcode);
    }
}

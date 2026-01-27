@extends('layouts.app')

@section('page_title', 'Scan QR Barcode')
@section('page_subtitle', 'Use your camera to scan student barcode')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Scan QR Barcode</h5>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <p class="text-muted mb-3">
                Point your camera at the student QR code to record attendance.
            </p>

            <!-- Div untuk scanner -->
            <div id="reader" style="width:100%; border:1px solid #ccc; border-radius:5px; height:400px;"></div>

            <!-- Form untuk submit barcode -->
            <form id="scanForm" method="POST" action="{{ route('attendance.scan.camera') }}">
                @csrf
                <input type="hidden" name="barcode" id="barcode">
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Library html5-qrcode -->
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const html5QrCode = new Html5Qrcode("reader");

            Html5Qrcode.getCameras().then(cameras => {
                console.log("Cameras detected:", cameras);
                if (cameras && cameras.length) {
                    // Pilih kamera belakang jika ada
                    let cameraId = cameras.find(cam => cam.label.toLowerCase().includes("back"))?.id ||
                        cameras[0].id;

                    html5QrCode.start(
                        cameraId, {
                            fps: 10,
                            qrbox: 250
                        },
                        qrCodeMessage => {
                            console.log("QR Code detected:", qrCodeMessage);
                            document.getElementById('barcode').value = qrCodeMessage;
                            document.getElementById('scanForm').submit();
                            html5QrCode.stop().then(() => {
                                console.log("Scanner stopped after successful scan.");
                            });
                        }
                    ).catch(err => {
                        console.error("Unable to start camera:", err);
                        alert("Unable to start camera: " + err);
                    });

                } else {
                    alert("No camera found. Please allow camera access or connect a camera.");
                }
            }).catch(err => {
                console.error("Error getting cameras:", err);
                alert("Unable to access camera: " + err);
            });
        });
    </script>
@endsection

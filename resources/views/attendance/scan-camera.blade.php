@extends('layouts.app')

@section('page_title', 'Scan QR Barcode')
@section('page_subtitle', 'Use the camera to scan student barcode')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Scan QR Barcode</h5>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <p class="text-muted mb-3">Point your camera at the student QR code to record attendance.</p>

            <video id="preview" class="w-100" style="border:1px solid #ccc; border-radius:5px;"></video>

            <form id="scanForm" method="POST" action="{{ route('attendance.scan.camera') }}">
                @csrf
                <input type="hidden" name="barcode" id="barcode">
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        const html5QrCode = new Html5Qrcode("preview");

        Html5Qrcode.getCameras().then(cameras => {
            if (cameras && cameras.length) {
                const cameraId = cameras[0].id;

                html5QrCode.start(
                    cameraId, {
                        fps: 10,
                        qrbox: 250
                    },
                    qrCodeMessage => {
                        document.getElementById('barcode').value = qrCodeMessage;
                        document.getElementById('scanForm').submit();
                    },
                    errorMessage => {
                        console.warn(errorMessage);
                    }
                ).catch(err => console.error(err));
            } else {
                alert("No camera found. Please allow camera access or connect a camera.");
            }
        }).catch(err => {
            console.error(err);
            alert("Unable to access camera: " + err);
        });
    </script>
@endsection

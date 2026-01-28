@extends('layouts.app')

@section('page_title', 'Scan QR Barcode')
@section('page_subtitle', 'Use the camera to scan student barcode')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Scan QR Barcode</h5>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <p class="text-muted mb-3">
                Point your camera at the student QR code to record attendance.
            </p>

            <div id="preview" style="width:100%; max-width:400px; margin:auto;"></div>

            <form id="scanForm" method="POST" action="{{ route('attendance.scan.camera.store') }}">
                @csrf
                <input type="hidden" name="barcode" id="barcode">
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const html5QrCode = new Html5Qrcode("preview");

            Html5Qrcode.getCameras().then(cameras => {
                if (!cameras.length) {
                    alert("Camera tidak ditemukan");
                    return;
                }

                html5QrCode.start(
                    cameras[0].id, {
                        fps: 10,
                        qrbox: 250
                    },
                    qrCodeMessage => {
                        document.getElementById('barcode').value = qrCodeMessage;
                        document.getElementById('scanForm').submit();
                        html5QrCode.stop();
                    },
                    errorMessage => {
                        console.warn(errorMessage);
                    }
                );
            }).catch(err => {
                console.error(err);
                alert("Tidak bisa mengakses camera");
            });
        });
    </script>
@endpush

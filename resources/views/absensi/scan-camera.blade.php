@extends('layouts.app')

@section('page_title', 'Scan QR Barcode')
@section('page_subtitle', 'Gunakan kamera untuk scan barcode siswa')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Scan QR Barcode</h5>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <video id="preview" class="w-100" style="border:1px solid #ccc; border-radius:5px"></video>

            <form id="scanForm" method="POST" action="{{ route('absensi.scan.camera') }}">
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

        html5QrCode.start({
                facingMode: "environment"
            }, {
                fps: 10,
                qrbox: 250
            },
            qrCodeMessage => {
                document.getElementById('barcode').value = qrCodeMessage;
                document.getElementById('scanForm').submit();
            },
            errorMessage => {
                // console.log(errorMessage);
            }
        ).catch(err => console.error(err));
    </script>
@endsection

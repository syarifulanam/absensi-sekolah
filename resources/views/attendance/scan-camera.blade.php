@extends('layouts.app')

@section('content')
    <h4 class="mb-3">📷 Scan QR Absensi</h4>

    <div class="card shadow-sm mb-3">
        <div class="card-body text-center">
            <div id="reader" style="width:300px;margin:auto;"></div>
            <div id="result" class="mt-3"></div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode"></script>

    <script>
        function onScanSuccess(decodedText) {
            fetch("{{ route('absensi.scan.camera') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        barcode: decodedText
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('result').innerHTML =
                            `<div class="alert alert-success">
                    ✔ ${data.name} (${data.class}) berhasil absen
                </div>`;
                    } else {
                        document.getElementById('result').innerHTML =
                            `<div class="alert alert-warning">${data.message}</div>`;
                    }
                });
        }

        new Html5Qrcode("reader").start({
                facingMode: "environment"
            },
            {
                fps: 10,
                qrbox: 250
            },
            onScanSuccess
        );
    </script>
@endsection

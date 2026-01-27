@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Scan QR Kamera</h4>
        <video id="preview" width="400" height="300" autoplay></video>
    </div>

    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        const html5QrCode = new Html5Qrcode("preview");

        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                const cameraId = devices[0].id;
                html5QrCode.start(
                    cameraId, {
                        fps: 10, 
                        qrbox: 250 
                    },
                    qrCodeMessage => {
                        console.log("QR Code detected:", qrCodeMessage);
                        alert("QR Code: " + qrCodeMessage);
                    },
                    errorMessage => {
                    }
                ).catch(err => {
                    console.error("Tidak bisa mengakses kamera:", err);
                });
            }
        }).catch(err => console.error(err));
    </script>
@endsection

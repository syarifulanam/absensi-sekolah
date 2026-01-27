<!DOCTYPE html>
<html>

<head>
    <title>QR Absensi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial;
            background: #f8f9fa;
        }

        .card {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, .1);
        }
    </style>
</head>

<body>

    <div class="card">
        <h3>{{ $student->name }}</h3>
        <p>{{ $student->class }}</p>

        <div style="margin:20px 0">
            {!! QrCode::size(250)->generate($student->barcode) !!}
        </div>

        <small>Tunjukkan QR ini ke guru</small>
    </div>

</body>

</html>

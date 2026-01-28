<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login | E-Absensi</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo-absensi.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center" style="min-height:100vh">

    <div class="card shadow-sm border-0" style="width:380px">
        <div class="card-body p-4">
            @yield('content')
        </div>
    </div>

</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <title>Absensi Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex">
        @include('layouts.sidebar')
        <div class="flex-fill p-4 bg-light">
            @yield('content')
        </div>
    </div>
</body>

</html>

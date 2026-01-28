<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'School Attendance System')</title>

    <link rel="icon" href="{{ asset('assets/images/logo-absensi.png') }}" type="image/png">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/logo-absensi.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/logo-absensi.png') }}">

    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo-absensi.png') }}">

    <meta property="og:title" content="School Attendance System">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('assets/images/logo-absensi.png') }}">
    <meta property="og:site_name" content="School Attendance">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    @stack('css')
</head>

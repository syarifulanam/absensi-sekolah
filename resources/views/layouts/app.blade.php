<!DOCTYPE html>
<html lang="id">

<head>
    @include('layouts.head')
</head>

<body>
    <div class="d-flex min-vh-100">

        @include('layouts.sidebar') <!-- Sidebar -->

        <div class="flex-fill d-flex flex-column">
            @include('layouts.topbar') <!-- Topbar -->

            <main class="flex-fill p-4 bg-light">
                @yield('content') <!-- Konten dashboard muncul di sini -->
            </main>

            @include('layouts.footer') <!-- Footer -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('js')
</body>

</html>

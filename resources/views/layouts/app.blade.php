<!DOCTYPE html>
<html lang="id">
@include('layouts.head')

<body class="bg-light">

    <div class="d-flex min-vh-100"> 

        @include('layouts.sidebar')

        <div class="flex-fill d-flex flex-column">

            @include('layouts.topbar')

            <main class="flex-fill p-4 bg-light">
                @yield('content')
            </main>

            @include('layouts.footer')

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('js')

</body>

</html>

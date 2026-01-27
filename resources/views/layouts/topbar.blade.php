<nav class="navbar navbar-expand bg-white shadow-sm mb-4 px-3">

    <button class="btn btn-outline-secondary me-3" id="toggleSidebar">
        <i class="bi bi-list"></i>
    </button>

    <div class="d-flex align-items-center">
        <img src="{{ asset('assets/images/logo-absensi.png') }}" alt="Logo Absensi" width="35" class="me-2">

        <div class="d-none d-md-block">
            <span class="fw-bold">Sistem Absensi</span><br>
            <small class="text-muted">@yield('page_title', 'Dashboard')</small>
        </div>
    </div>

    <div class="ms-auto d-flex align-items-center gap-3">

        <span class="text-muted d-none d-md-inline">
            <i class="bi bi-calendar-event"></i>
            {{ now()->translatedFormat('l, d F Y') }}
        </span>

        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown">
                <i class="bi bi-person-circle fs-4 me-1"></i>
                <span class="fw-semibold">{{ auth()->user()->name ?? 'User' }}</span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-person"></i> Profile
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </div>
</nav>

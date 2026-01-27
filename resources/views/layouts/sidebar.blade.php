<div id="sidebar" class="bg-dark text-white d-flex flex-column p-3 sidebar"
    style="width:260px; min-height:100vh; transition:0.3s">

    <div class="text-center mb-4">
        <img src="{{ asset('assets/images/logo-absensi.png') }}" width="60" class="mb-2">
        <h4 class="fw-bold mb-0">E-ABSENSI</h4>
        <small class="text-secondary">School System</small>
    </div>

    <ul class="nav nav-pills flex-column gap-1">
        @auth
            @php
                $role = auth()->user()->role;
            @endphp

            @if ($role === 'admin')
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}"
                        class="nav-link text-white {{ request()->is('dashboard') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-speedometer2"></i> <span class="ms-2">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/siswa') }}"
                        class="nav-link text-white {{ request()->is('siswa*') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-people"></i> <span class="ms-2">Data Siswa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/guru') }}"
                        class="nav-link text-white {{ request()->is('guru*') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-person-badge"></i> <span class="ms-2">Data Guru</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/absensi') }}"
                        class="nav-link text-white {{ request()->is('absensi') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-gear"></i> <span class="ms-2">Kelola Absen</span>
                    </a>
                </li>
                <li class="nav-item mt-2">
                    <a href="{{ url('/laporan') }}"
                        class="nav-link text-white {{ request()->is('laporan*') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-file-earmark-text"></i> <span class="ms-2">Laporan</span>
                    </a>
                </li>
            @elseif($role === 'guru')
                <li class="nav-item">
                    <a href="{{ url('/absensi/scan') }}"
                        class="nav-link text-white {{ request()->is('absensi/scan') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-upc-scan"></i> <span class="ms-2">Scan Absensi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/absensi/scan-camera') }}"
                        class="nav-link text-white {{ request()->is('absensi/scan-camera') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-camera"></i> <span class="ms-2">Scan QR Kamera</span>
                    </a>
                </li>
                <li class="nav-item mt-2">
                    <a href="{{ url('/laporan') }}"
                        class="nav-link text-white {{ request()->is('laporan*') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-file-earmark-text"></i> <span class="ms-2">Laporan</span>
                    </a>
                </li>
            @elseif($role === 'siswa')
                <li class="nav-item">
                    <a href="{{ url('/absensi/scan') }}"
                        class="nav-link text-white {{ request()->is('absensi/scan') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-upc-scan"></i> <span class="ms-2">Scan Absensi</span>
                    </a>
                </li>
            @endif
        @endauth
    </ul>
</div>

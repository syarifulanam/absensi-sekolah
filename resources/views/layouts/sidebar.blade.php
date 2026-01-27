<div id="sidebar" class="bg-dark text-white d-flex flex-column p-3 sidebar"
    style="width:260px; min-height:100vh; transition:0.3s">

    <div class="text-center mb-4">
        <img src="{{ asset('assets/images/logo-absensi.png') }}" width="60" class="mb-2">
        <h4 class="fw-bold mb-0">E-ABSENSI</h4>
        <small class="text-secondary">School System</small>
    </div>

    @auth
        @php
            $role = auth()->user()->role ?? '';
        @endphp

        <ul class="nav nav-pills flex-column gap-2">
            @if ($role === 'admin')
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}"
                        class="nav-link text-white {{ request()->is('dashboard') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-speedometer2"></i> <span class="ms-2">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/students') }}"
                        class="nav-link text-white {{ request()->is('students*') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-people"></i> <span class="ms-2">Students</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/teachers') }}"
                        class="nav-link text-white {{ request()->is('teachers*') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-person-badge"></i> <span class="ms-2">Teachers</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/attendance') }}"
                        class="nav-link text-white {{ request()->is('attendance') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-gear"></i> <span class="ms-2">Manage Attendance</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/attendance/scan-camera') }}"
                        class="nav-link text-white {{ request()->is('attendance/scan-camera') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-camera"></i> <span class="ms-2">QR Scan Camera</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/reports') }}"
                        class="nav-link text-white {{ request()->is('reports*') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-file-earmark-text"></i> <span class="ms-2">Reports</span>
                    </a>
                </li>
            @endif

            @if ($role === 'guru')
                <li class="nav-item">
                    <a href="{{ url('/monitoring') }}"
                        class="nav-link text-white {{ request()->is('monitoring*') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-upc-scan"></i> <span class="ms-2">Monitoring</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/attendance/scan-camera') }}"
                        class="nav-link text-white {{ request()->is('scan-camera') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-camera"></i> <span class="ms-2">QR Scan Camera</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/reports') }}"
                        class="nav-link text-white {{ request()->is('reports*') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-file-earmark-text"></i> <span class="ms-2">Reports</span>
                    </a>
                </li>
            @endif

            @if ($role === 'siswa')
                <li class="nav-item mb-2">
                    <a href="{{ url('student/my-card') }}"
                        class="nav-link text-white {{ request()->is('my-card*') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-card-list"></i> <span class="ms-2">My Card</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/attendance/scan-camera') }}"
                        class="nav-link text-white {{ request()->is('scan-camera') ? 'active bg-primary' : '' }}">
                        <i class="bi bi-camera"></i> <span class="ms-2">QR Scan Camera</span>
                    </a>
                </li>
            @endif
        </ul>
    @endauth
</div>

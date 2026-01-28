@extends('layouts.guest')

@section('content')
    <div class="text-center mb-4">
        <img src="{{ asset('assets/images/logo-absensi.png') }}" width="70" class="mb-2">
        <h4 class="fw-bold mb-0">E-ABSENSI</h4>
        <small class="text-muted">School System</small>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger py-2 text-center">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="btn-group w-100 mb-3" role="group">
        <input type="radio" class="btn-check" name="role" id="admin" value="admin" checked>
        <label class="btn btn-outline-primary" for="admin">
            <i class="bi bi-shield-lock"></i> Admin
        </label>

        <input type="radio" class="btn-check" name="role" id="teacher" value="guru">
        <label class="btn btn-outline-success" for="teacher">
            <i class="bi bi-person-badge"></i> Teacher
        </label>

        <input type="radio" class="btn-check" name="role" id="student" value="siswa">
        <label class="btn btn-outline-warning" for="student">
            <i class="bi bi-mortarboard"></i> Student
        </label>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="hidden" name="role" id="selectedRole" value="admin">

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-person"></i>
                </span>
                <input type="text" name="name" class="form-control" placeholder="Full name" required autofocus>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope"></i>
                </span>
                <input type="email" name="email" class="form-control" placeholder="email@school.id" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-lock"></i>
                </span>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-lock-fill"></i>
                </span>
                <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
            </div>
        </div>

        <button class="btn btn-success w-100 py-2">
            <i class="bi bi-person-plus me-1"></i> Register
        </button>
    </form>

    <div class="text-center mt-4">
        <small class="text-muted">
            © {{ date('Y') }} E-Absensi School
        </small>
    </div>

    <script>
        document.querySelectorAll('input[name="role"]').forEach(el => {
            el.addEventListener('change', function() {
                document.getElementById('selectedRole').value = this.value;
            });
        });
    </script>
@endsection

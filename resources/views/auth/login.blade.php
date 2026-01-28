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

        <input type="radio" class="btn-check" name="role" id="teacher" value="teacher">
        <label class="btn btn-outline-success" for="teacher">
            <i class="bi bi-person-badge"></i> Teacher
        </label>

        <input type="radio" class="btn-check" name="role" id="student" value="student">
        <label class="btn btn-outline-warning" for="student">
            <i class="bi bi-mortarboard"></i> Student
        </label>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input type="hidden" name="role" id="selectedRole" value="admin">

        <div class="mb-3">
            <label class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope"></i>
                </span>
                <input type="email" name="email" class="form-control" placeholder="email@school.id" required autofocus>
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

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="remember">
                <label class="form-check-label">Remember me</label>
            </div>

            <div>
                <a href="{{ route('forgot.password') }}" class="text-decoration-none">Forgot Password?</a>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('register') }}">Don't have an account? Register</a>
        </div>

        <button class="btn btn-primary w-100 py-2">
            <i class="bi bi-box-arrow-in-right me-1"></i>
            Login
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

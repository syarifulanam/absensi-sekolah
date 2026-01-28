@extends('layouts.guest')

@section('content')
    <div class="text-center mb-4">
        <img src="{{ asset('assets/images/logo-absensi.png') }}" width="70" class="mb-2">
        <h4 class="fw-bold mb-0">E-ABSENSI</h4>
        <small class="text-muted">School System</small>
    </div>

    @if (session('status'))
        <div class="alert alert-success py-2 text-center">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger py-2 text-center">
            {{ $errors->first() }}
        </div>
    @endif

    <p class="text-center mb-3">Enter your email to receive the password reset link.</p>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="email@school.id" required autofocus>
            </div>
        </div>

        <button class="btn btn-primary w-100 py-2">
            <i class="bi bi-envelope-open me-1"></i> Send Reset Link
        </button>
    </form>

    <div class="text-center mt-3">
        <a href="{{ route('login') }}" class="text-decoration-none">Back to Login</a>
    </div>

    <div class="text-center mt-4">
        <small class="text-muted">
            © {{ date('Y') }} E-Absensi School
        </small>
    </div>
@endsection

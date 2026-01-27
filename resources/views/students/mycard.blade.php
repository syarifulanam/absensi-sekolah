@extends('layouts.app')

@section('page_title', 'Kartu Saya')

@section('content')
    <div class="d-flex justify-content-center mt-4">
        <div class="card p-3"
            style="width: 350px; border: 2px solid #0d6efd; border-radius: 10px; background-color: #f8f9fa;">

            <div class="text-center mb-3">
                <img src="{{ asset('assets/images/logo-absensi.png') }}" width="60" class="mb-1">
                <h5 class="fw-bold mb-0">E-ABSENSI</h5>
                <small>School System</small>
            </div>

            <hr style="border-top: 2px solid #0d6efd;">

            <div class="text-center mb-3">
                <h6 class="fw-bold">{{ $student->name }}</h6>
                <p class="mb-1">{{ $student->email }}</p>
                <span class="badge bg-primary">{{ ucfirst($student->role) }}</span>
            </div>

            <div class="text-center mt-3">
                <img src="data:image/png;base64,{{ $barcode }}" alt="Barcode" style="width: 80%; max-width: 250px;">
                <div class="mt-2">ID: {{ $student->id }}</div>
            </div>

            <hr style="border-top: 2px solid #0d6efd;">

            <div class="text-center mt-2">
                <small class="text-muted">© {{ date('Y') }} E-Absensi Sekolah</small>
            </div>
        </div>
    </div>
@endsection

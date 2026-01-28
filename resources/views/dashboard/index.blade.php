@extends('layouts.app')

@section('page_title', 'Dashboard')
@section('page_subtitle', 'Ringkasan Absensi Hari Ini')

@section('content')
    <div class="container-fluid">

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-people fs-1 text-primary me-3"></i>
                        <div>
                            <h5 class="mb-0">Siswa</h5>
                            <small class="text-muted">{{ $students_count ?? 0 }} terdaftar</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-person-badge fs-1 text-success me-3"></i>
                        <div>
                            <h5 class="mb-0">Guru</h5>
                            <small class="text-muted">{{ $teachers_count ?? 0 }} terdaftar</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-check2-square fs-1 text-warning me-3"></i>
                        <div>
                            <h5 class="mb-0">Absensi Hari Ini</h5>
                            <small class="text-muted">{{ $attendance_today ?? 0 }} siswa hadir</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5>Selamat datang, {{ auth()->user()->name }}!</h5>
                <p>Ini adalah ringkasan absensi hari ini.</p>
            </div>
        </div>

    </div>
@endsection

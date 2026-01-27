@extends('layouts.app')

@section('page_title', 'Daftar Absensi')
@section('page_subtitle', 'Absensi Siswa')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Daftar Absensi</h5>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $attendance)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $attendance->student->name ?? '-' }}</td>
                            <td>{{ $attendance->date }}</td>
                            <td>{{ $attendance->time }}</td>
                            <td>{{ ucfirst($attendance->status) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada absensi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

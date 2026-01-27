@extends('layouts.app')

@section('page_title', 'Monitoring Absensi')
@section('page_subtitle', 'Pantau absensi siswa')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Monitoring Absensi</h5>

            <table class="table table-hover table-bordered">
                <thead class="table-dark">
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

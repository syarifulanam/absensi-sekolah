@extends('layouts.app')

@section('page_title', 'My Attendance')
@section('page_subtitle', 'Student Attendance History')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <h5 class="card-title mb-3">
                <i class="bi bi-list-check me-1"></i> Attendance History
            </h5>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Barcode</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $attendance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                                <td>{{ $attendance->time }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        {{ ucfirst($attendance->status) }}
                                    </span>
                                </td>
                                <td class="text-muted">
                                    {{ $attendance->barcode }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    No attendance records found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection

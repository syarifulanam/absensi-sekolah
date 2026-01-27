@extends('layouts.app')

@section('page_title', 'Attendance List')
@section('page_subtitle', 'Student Attendance')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Attendance List</h5>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Date</th>
                        <th>Time</th>
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
                            <td colspan="5" class="text-center">No attendance records yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

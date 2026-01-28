@extends('layouts.app')

@section('page_title', 'Attendance List')
@section('page_subtitle', 'Student Attendance')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Attendance List</h5>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $attendance)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $attendance->student->name ?? '-' }}</td>
                            <td>{{ ucfirst($attendance->status) }}</td>
                            <td>{{ $attendance->date }}</td>
                            <td>{{ $attendance->time }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                No attendance data
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

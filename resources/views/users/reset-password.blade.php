@extends('layouts.app')

@section('page_title', 'Reset Password')
@section('page_subtitle', 'Change user password')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Reset Password for {{ $user->name }}</h5>

            <form action="{{ route('users.update-password', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        required>
                </div>


                <button type="submit" class="btn btn-primary">Update Password</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection

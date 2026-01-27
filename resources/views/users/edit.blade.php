@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">
            <i class="bi bi-people me-1"></i> Edit User
        </h4>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle me-1"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger py-2">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password <small class="text-muted">(kosongkan jika tidak
                            diubah)</small></label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="guru" {{ old('role', $user->role) == 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="siswa" {{ old('role', $user->role) == 'siswa' ? 'selected' : '' }}>Siswa</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-pencil-square me-1"></i> Update User
                </button>
            </form>
        </div>
    </div>
@endsection

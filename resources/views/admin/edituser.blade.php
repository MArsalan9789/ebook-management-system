@extends('layouts.admin')

@section('content')

<div class="container mt-5">
    <h2>Edit User</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form with ID for JS submit -->
    <form id="updateUserForm{{ $user->id }}" action="{{ route('userupdate', $user->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="user"  {{ $user->role=='user'?'selected':'' }}>User</option>
                <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
            </select>
        </div>

        <!-- Update button with SweetAlert confirm -->
        <button type="button" class="btn btn-danger" onclick="confirmUpdate({{ $user->id }})">
            Update User
        </button>
    </form>
</div>

@endsection

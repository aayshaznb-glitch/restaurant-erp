@extends('layouts.app')
@section('title', 'Edit User')

@section('content')
<div class="card stat-card p-4" style="max-width:550px;">
    <h5 class="mb-3">Edit User</h5>
    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="row g-2">
            <div class="col-6">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    @foreach(['admin','manager','waiter','kitchen','cashier'] as $role)
                        <option value="{{ $role }}" @selected($user->role === $role)>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="active" @selected($user->status === 'active')>Active</option>
                    <option value="inactive" @selected($user->status === 'inactive')>Inactive</option>
                </select>
            </div>
        </div>
        <div class="mb-3 mt-3">
            <label class="form-label">New Password (leave blank to keep current)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Confirm New Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <button class="btn btn-danger">Update User</button>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
@endsection

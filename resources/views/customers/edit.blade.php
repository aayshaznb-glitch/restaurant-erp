@extends('layouts.app')
@section('title', 'Edit Customer')

@section('content')
<div class="card stat-card p-4" style="max-width:550px;">
    <h5 class="mb-3">Edit Customer</h5>
    <form method="POST" action="{{ route('customers.update', $customer) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $customer->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $customer->phone) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $customer->email) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Feedback</label>
            <textarea name="feedback" class="form-control" rows="2">{{ old('feedback', $customer->feedback) }}</textarea>
        </div>
        <button class="btn btn-danger">Update Customer</button>
        <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
@endsection

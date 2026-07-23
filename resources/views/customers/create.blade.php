@extends('layouts.app')
@section('title', 'Add Customer')

@section('content')
<div class="card stat-card p-4" style="max-width:550px;">
    <h5 class="mb-3">Add Customer</h5>
    <form method="POST" action="{{ route('customers.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Feedback</label>
            <textarea name="feedback" class="form-control" rows="2">{{ old('feedback') }}</textarea>
        </div>
        <button class="btn btn-danger">Save Customer</button>
        <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
@endsection

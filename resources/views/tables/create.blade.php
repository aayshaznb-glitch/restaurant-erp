@extends('layouts.app')
@section('title', 'Add Table')

@section('content')
<div class="card stat-card p-4" style="max-width:500px;">
    <h5 class="mb-3">Add Table</h5>
    <form method="POST" action="{{ route('tables.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Table Number</label>
            <input type="text" name="table_number" class="form-control" value="{{ old('table_number') }}" placeholder="e.g. T11" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Capacity</label>
            <input type="number" min="1" name="capacity" class="form-control" value="{{ old('capacity', 2) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="available">Available</option>
                <option value="reserved">Reserved</option>
                <option value="occupied">Occupied</option>
                <option value="cleaning">Cleaning</option>
            </select>
        </div>
        <button class="btn btn-danger">Save Table</button>
        <a href="{{ route('tables.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
@endsection

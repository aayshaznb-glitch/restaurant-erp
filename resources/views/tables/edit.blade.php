@extends('layouts.app')
@section('title', 'Edit Table')

@section('content')
<div class="card stat-card p-4" style="max-width:500px;">
    <h5 class="mb-3">Edit Table</h5>
    <form method="POST" action="{{ route('tables.update', $table) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Table Number</label>
            <input type="text" name="table_number" class="form-control" value="{{ old('table_number', $table->table_number) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Capacity</label>
            <input type="number" min="1" name="capacity" class="form-control" value="{{ old('capacity', $table->capacity) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                @foreach(['available','reserved','occupied','cleaning'] as $status)
                    <option value="{{ $status }}" @selected($table->status === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-danger">Update Table</button>
        <a href="{{ route('tables.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Tables')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Restaurant Tables</h5>
    <a href="{{ route('tables.create') }}" class="btn btn-danger btn-sm"><i class="bi bi-plus-lg"></i> Add Table</a>
</div>

<div class="row g-3">
    @forelse($tables as $table)
    @php
        $statusColors = ['available' => 'success', 'reserved' => 'info', 'occupied' => 'danger', 'cleaning' => 'warning'];
    @endphp
    <div class="col-6 col-md-4 col-xl-3">
        <div class="card stat-card p-3 h-100 text-center">
            <div class="fs-4 fw-bold">{{ $table->table_number }}</div>
            <div class="text-secondary small mb-2"><i class="bi bi-people"></i> {{ $table->capacity }} seats</div>
            <span class="badge bg-{{ $statusColors[$table->status] }} mb-2">{{ ucfirst($table->status) }}</span>
            <form action="{{ route('tables.updateStatus', $table) }}" method="POST" class="mb-2">
                @csrf @method('PATCH')
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                    @foreach(['available','reserved','occupied','cleaning'] as $status)
                        <option value="{{ $status }}" @selected($table->status === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </form>
            <div class="d-flex justify-content-center gap-1">
                <a href="{{ route('tables.edit', $table) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('tables.destroy', $table) }}" method="POST" onsubmit="return confirm('Remove this table?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center text-secondary py-4">No tables set up yet.</div>
    @endforelse
</div>
<div class="mt-3">{{ $tables->links() }}</div>
@endsection

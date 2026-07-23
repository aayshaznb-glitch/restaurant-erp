@extends('layouts.app')
@section('title', 'Edit Supplier')

@section('content')
<div class="card stat-card p-4" style="max-width:550px;">
    <h5 class="mb-3">Edit Supplier</h5>
    <form method="POST" action="{{ route('suppliers.update', $supplier) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Supplier Name</label>
            <input type="text" name="supplier_name" class="form-control" value="{{ old('supplier_name', $supplier->supplier_name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $supplier->phone) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $supplier->address) }}">
        </div>
        <button class="btn btn-danger">Update Supplier</button>
        <a href="{{ route('suppliers.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
@endsection

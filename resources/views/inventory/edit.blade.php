@extends('layouts.app')
@section('title', 'Edit Ingredient')

@section('content')
<div class="card stat-card p-4" style="max-width:550px;">
    <h5 class="mb-3">Edit Ingredient</h5>
    <form method="POST" action="{{ route('inventory.update', ['inventory' => $inventoryItem->id]) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Item Name</label>
            <input type="text" name="item_name" class="form-control" value="{{ old('item_name', $inventoryItem->item_name) }}" required>
        </div>
        <div class="row g-2">
            <div class="col-6">
                <label class="form-label">Quantity</label>
                <input type="number" step="0.01" min="0" name="quantity" class="form-control" value="{{ old('quantity', $inventoryItem->quantity) }}" required>
            </div>
            <div class="col-6">
                <label class="form-label">Unit</label>
                <input type="text" name="unit" class="form-control" value="{{ old('unit', $inventoryItem->unit) }}" required>
            </div>
        </div>
        <div class="mb-3 mt-3">
            <label class="form-label">Low Stock Threshold</label>
            <input type="number" step="0.01" min="0" name="low_stock_threshold" class="form-control" value="{{ old('low_stock_threshold', $inventoryItem->low_stock_threshold) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Supplier</label>
            <select name="supplier_id" class="form-select">
                <option value="">None</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" @selected(old('supplier_id', $inventoryItem->supplier_id) == $supplier->id)>{{ $supplier->supplier_name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-danger">Update Ingredient</button>
        <a href="{{ route('inventory.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
@endsection

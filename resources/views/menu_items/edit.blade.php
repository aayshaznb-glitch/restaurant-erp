@extends('layouts.app')
@section('title', 'Edit Menu Item')

@section('content')
<div class="card stat-card p-4" style="max-width:600px;">
    <h5 class="mb-3">Edit Menu Item</h5>
    <form method="POST" action="{{ route('menu-items.update', $menuItem) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $menuItem->category_id) == $category->id)>{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Item Name</label>
            <input type="text" name="item_name" class="form-control" value="{{ old('item_name', $menuItem->item_name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="2">{{ old('description', $menuItem->description) }}</textarea>
        </div>
        <div class="row g-2">
            <div class="col-6">
                <label class="form-label">Price</label>
                <input type="number" step="0.01" min="0" name="price" class="form-control" value="{{ old('price', $menuItem->price) }}" required>
            </div>
            <div class="col-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="available" @selected($menuItem->status === 'available')>Available</option>
                    <option value="unavailable" @selected($menuItem->status === 'unavailable')>Unavailable</option>
                </select>
            </div>
        </div>
        <div class="mb-3 mt-3">
            @if($menuItem->image)
                <img src="{{ asset('storage/'.$menuItem->image) }}" style="height:80px;" class="rounded mb-2 d-block">
            @endif
            <label class="form-label">Replace Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <button class="btn btn-danger">Update Item</button>
        <a href="{{ route('menu-items.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
@endsection

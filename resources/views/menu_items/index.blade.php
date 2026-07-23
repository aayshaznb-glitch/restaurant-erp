@extends('layouts.app')
@section('title', 'Menu Items')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <h5 class="mb-0">Menu Items</h5>
    <a href="{{ route('menu-items.create') }}" class="btn btn-danger btn-sm"><i class="bi bi-plus-lg"></i> Add Menu Item</a>
</div>

<form method="GET" class="row g-2 mb-3">
    <div class="col-12 col-sm-5 col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Search item name..." value="{{ request('search') }}">
    </div>
    <div class="col-8 col-sm-4 col-md-3">
        <select name="category_id" class="form-select">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->category_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-4 col-sm-3 col-md-2">
        <button class="btn btn-outline-secondary w-100"><i class="bi bi-filter"></i> Filter</button>
    </div>
</form>

<div class="row g-3">
    @forelse($menuItems as $item)
    <div class="col-6 col-md-4 col-xl-3">
        <div class="card stat-card h-100">
            <div class="ratio ratio-4x3 bg-light d-flex align-items-center justify-content-center">
                @if($item->image)
                    <img src="{{ asset('storage/'.$item->image) }}" class="w-100 h-100" style="object-fit:cover;">
                @else
                    <i class="bi bi-egg-fried fs-1 text-secondary"></i>
                @endif
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                    <span class="fw-semibold flex-fill text-truncate" style="min-width: 0;">{{ $item->item_name }}</span>
                    <span class="badge {{ $item->status === 'available' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($item->status) }}</span>
                </div>
                <div class="text-secondary small">{{ $item->category->category_name ?? '—' }}</div>
                <div class="fw-bold mt-1">Rs.{{ number_format($item->price, 2) }}</div>
            </div>
            <div class="card-footer bg-white d-flex justify-content-end gap-1">
                <a href="{{ route('menu-items.edit', $item) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('menu-items.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this item?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center text-secondary py-4">No menu items found.</div>
    @endforelse
</div>
<div class="mt-3">{{ $menuItems->links() }}</div>
@endsection

@extends('layouts.app')
@section('title', 'Inventory')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <h5 class="mb-0">Inventory</h5>
    <a href="{{ route('inventory.create') }}" class="btn btn-danger btn-sm"><i class="bi bi-plus-lg"></i> Add Ingredient</a>
</div>

<form method="GET" class="mb-3">
    <div class="form-check">
        <input type="checkbox" name="low_stock" value="1" class="form-check-input" id="lowStock" onchange="this.form.submit()" @checked(request('low_stock'))>
        <label class="form-check-label" for="lowStock">Show low stock only</label>
    </div>
</form>

<div class="card stat-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Ingredient</th><th>Quantity</th><th>Supplier</th><th>Status</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->quantity }} {{ $item->unit }}</td>
                    <td>{{ $item->supplier->supplier_name ?? '—' }}</td>
                    <td>
                        @if($item->stock_status === 'low')
                            <span class="badge bg-danger">Low Stock</span>
                        @else
                            <span class="badge bg-success">OK</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('inventory.edit', $item->id) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this ingredient?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-secondary py-3">No inventory items yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $items->links() }}</div>
@endsection

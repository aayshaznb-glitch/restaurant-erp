@extends('layouts.app')
@section('title', 'Kitchen Queue')

@section('content')
<h5 class="mb-3">Kitchen Order Queue</h5>

<div class="row g-3">
    @forelse($orders as $order)
    <div class="col-12 col-md-6 col-xl-4">
        <div class="card stat-card h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Order #{{ $order->id }} — {{ $order->table->table_number ?? '—' }}</span>
                <span class="badge {{ $order->statusBadgeClass() }}">{{ ucfirst($order->order_status) }}</span>
            </div>
            <ul class="list-group list-group-flush">
                @foreach($order->items as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center gap-2 flex-wrap">
                    <span>{{ $item->quantity }}x {{ $item->menuItem->item_name ?? '—' }}</span>
                    <form action="{{ route('kitchen.updateItemStatus', $item) }}" method="POST" class="d-flex align-items-center gap-1">
                        @csrf @method('PATCH')
                        <select name="kitchen_status" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="pending" @selected($item->kitchen_status === 'pending')>Pending</option>
                            <option value="preparing" @selected($item->kitchen_status === 'preparing')>Preparing</option>
                            <option value="ready" @selected($item->kitchen_status === 'ready')>Ready</option>
                        </select>
                    </form>
                </li>
                @endforeach
            </ul>
            @if($order->special_instructions)
            <div class="card-footer bg-white small text-warning-emphasis">
                <i class="bi bi-info-circle"></i> {{ $order->special_instructions }}
            </div>
            @endif
        </div>
    </div>
    @empty
    <div class="col-12 text-center text-secondary py-5">
        <i class="bi bi-emoji-smile fs-1 d-block mb-2"></i>
        No active orders in the kitchen right now.
    </div>
    @endforelse
</div>
@endsection

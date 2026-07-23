@extends('layouts.app')
@section('title', 'New Invoice')

@section('content')
<h5 class="mb-3">Orders Ready for Billing</h5>

<div class="row g-3">
    @forelse($orders as $order)
    <div class="col-12 col-md-6 col-xl-4">
        <div class="card stat-card p-3 h-100">
            <div class="d-flex justify-content-between">
                <span class="fw-semibold">Order #{{ $order->id }}</span>
                <span class="badge {{ $order->statusBadgeClass() }}">{{ ucfirst($order->order_status) }}</span>
            </div>
            <div class="text-secondary small mb-2">Table {{ $order->table->table_number ?? '—' }} · {{ $order->items->count() }} items</div>
            <div class="fw-bold mb-2">Rs.{{ number_format($order->total_amount, 2) }}</div>
            <a href="{{ route('payments.bill', $order) }}" class="btn btn-danger btn-sm">Generate Bill</a>
        </div>
    </div>
    @empty
    <div class="col-12 text-center text-secondary py-4">No orders awaiting payment.</div>
    @endforelse
</div>
@endsection

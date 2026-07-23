@extends('layouts.app')
@section('title', 'Order #'.$order->id)

@section('content')
<div class="row g-3">
    <div class="col-12 col-lg-8">
        <div class="card stat-card p-4 mb-3">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                <div>
                    <h5 class="mb-1">Order #{{ $order->id }}</h5>
                    <div class="text-secondary small">{{ $order->order_date->format('d M Y, H:i') }}</div>
                </div>
                <span class="badge fs-6 {{ $order->statusBadgeClass() }}">{{ ucfirst($order->order_status) }}</span>
            </div>
            <hr>
            <div class="row g-2 mb-3">
                <div class="col-6 col-md-3"><div class="text-secondary small">Table</div><div class="fw-semibold">{{ $order->table->table_number ?? '—' }}</div></div>
                <div class="col-6 col-md-3"><div class="text-secondary small">Waiter</div><div class="fw-semibold">{{ $order->waiter->name ?? '—' }}</div></div>
                <div class="col-6 col-md-3"><div class="text-secondary small">Customer</div><div class="fw-semibold">{{ $order->customer->name ?? 'Walk-in' }}</div></div>
                <div class="col-6 col-md-3"><div class="text-secondary small">Total</div><div class="fw-semibold">${{ number_format($order->total_amount, 2) }}</div></div>
            </div>
            @if($order->special_instructions)
            <div class="alert alert-warning py-2 small">Note: {{ $order->special_instructions }}</div>
            @endif

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr><th>Item</th><th>Qty</th><th>Price</th><th>Subtotal</th><th>Kitchen Status</th></tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->menuItem->item_name ?? '—' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rs.{{ number_format($item->price, 2) }}</td>
                            <td>Rs.{{ number_format($item->subtotal(), 2) }}</td>
                            <td><span class="badge bg-light text-dark border">{{ ucfirst($item->kitchen_status) }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card stat-card p-4 mb-3">
            <h6 class="mb-3">Update Status</h6>
            <form method="POST" action="{{ route('orders.updateStatus', $order) }}">
                @csrf @method('PATCH')
                <select name="order_status" class="form-select mb-2">
                    @foreach(['pending','confirmed','preparing','ready','served','completed','cancelled'] as $status)
                        <option value="{{ $status }}" @selected($order->order_status === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                <button class="btn btn-danger w-100">Update</button>
            </form>
        </div>

        @if($order->payment)
        <div class="card stat-card p-4">
            <h6 class="mb-2">Payment</h6>
            <div class="small text-secondary">Method: {{ ucfirst($order->payment->payment_method) }}</div>
            <div class="small text-secondary">Amount: ${{ number_format($order->payment->amount, 2) }}</div>
            <span class="badge bg-success mt-2">Paid</span>
        </div>
        @else
        <div class="card stat-card p-4 text-center text-secondary small">
            No payment recorded yet.
        </div>
        @endif
    </div>
</div>
@endsection

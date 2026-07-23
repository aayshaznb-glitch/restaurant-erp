@extends('layouts.app')
@section('title', 'Orders')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <h5 class="mb-0">Orders</h5>
    <a href="{{ route('orders.create') }}" class="btn btn-danger btn-sm"><i class="bi bi-plus-lg"></i> New Order</a>
</div>

<form method="GET" class="row g-2 mb-3">
    <div class="col-8 col-sm-4 col-md-3">
        <select name="status" class="form-select" onchange="this.form.submit()">
            <option value="">All Statuses</option>
            @foreach(['pending','confirmed','preparing','ready','served','completed','cancelled'] as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </div>
</form>

<div class="card stat-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>#</th><th>Table</th><th>Waiter</th><th>Status</th><th>Total</th><th>Date</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->table->table_number ?? '—' }}</td>
                    <td>{{ $order->waiter->name ?? '—' }}</td>
                    <td><span class="badge {{ $order->statusBadgeClass() }}">{{ ucfirst($order->order_status) }}</span></td>
                    <td>Rs.{{ number_format($order->total_amount, 2) }}</td>
                    <td>{{ $order->order_date->format('d M, H:i') }}</td>
                    <td class="text-end">
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-secondary py-3">No orders found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $orders->links() }}</div>
@endsection

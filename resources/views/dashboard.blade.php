@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="row g-3 mb-3">
    <div class="col-6 col-md-4 col-xl-3">
        <div class="card stat-card p-3 h-100">
            <div class="text-secondary small">Today's Orders</div>
            <div class="fs-3 fw-bold">{{ $todaysOrders }}</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-3">
        <div class="card stat-card p-3 h-100">
            <div class="text-secondary small">Pending Orders</div>
            <div class="fs-3 fw-bold text-warning">{{ $pendingOrders }}</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-3">
        <div class="card stat-card p-3 h-100">
            <div class="text-secondary small">Available Tables</div>
            <div class="fs-3 fw-bold text-success">{{ $availableTables }} / {{ $totalTables }}</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-3">
        <div class="card stat-card p-3 h-100">
            <div class="text-secondary small">Menu Items</div>
            <div class="fs-3 fw-bold">{{ $totalMenuItems }}</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-3">
        <div class="card stat-card p-3 h-100">
            <div class="text-secondary small">Low Stock Ingredients</div>
            <div class="fs-3 fw-bold text-danger">{{ $lowStockCount }}</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-3">
        <div class="card stat-card p-3 h-100">
            <div class="text-secondary small">Today's Sales</div>
            <div class="fs-3 fw-bold">Rs.{{ number_format($todaysSales, 2) }}</div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-3">
        <div class="card stat-card p-3 h-100">
            <div class="text-secondary small">Monthly Revenue</div>
            <div class="fs-3 fw-bold text-primary">Rs.{{ number_format($monthlyRevenue, 2) }}</div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-12 col-lg-7">
        <div class="card stat-card h-100">
            <div class="card-header bg-white fw-semibold">Recent Orders</div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr><th>#</th><th>Table</th><th>Waiter</th><th>Status</th><th>Total</th></tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->table->table_number ?? '—' }}</td>
                            <td>{{ $order->waiter->name ?? '—' }}</td>
                            <td><span class="badge {{ $order->statusBadgeClass() }}">{{ ucfirst($order->order_status) }}</span></td>
                            <td>Rs.{{ number_format($order->total_amount, 2) }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-secondary py-3">No orders yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-5">
        <div class="card stat-card h-100">
            <div class="card-header bg-white fw-semibold">Low Stock Alerts</div>
            <ul class="list-group list-group-flush">
                @forelse($lowStockItems as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $item->item_name }}
                    <span class="badge bg-danger">{{ $item->quantity }} {{ $item->unit }}</span>
                </li>
                @empty
                <li class="list-group-item text-secondary text-center">All ingredients well stocked.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection

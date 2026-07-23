@extends('layouts.app')
@section('title', 'Reports')

@section('content')
<form method="GET" class="mb-3">
    <select name="range" class="form-select" style="max-width:220px;" onchange="this.form.submit()">
        <option value="daily" @selected($range === 'daily')>Today</option>
        <option value="weekly" @selected($range === 'weekly')>Last 7 Days</option>
        <option value="monthly" @selected($range === 'monthly')>This Month</option>
    </select>
</form>

<div class="row g-3 mb-3">
    <div class="col-12 col-md-4">
        <div class="card stat-card p-3">
            <div class="text-secondary small">Sales Total</div>
            <div class="fs-3 fw-bold text-success">Rs.{{ number_format($salesTotal, 2) }}</div>
        </div>
    </div>
    <div class="col-12 col-md-8">
        <div class="card stat-card p-3">
            <div class="text-secondary small mb-2">Orders by Status</div>
            <div class="d-flex flex-wrap gap-2">
                @forelse($ordersByStatus as $status => $count)
                    <span class="badge bg-secondary">{{ ucfirst($status) }}: {{ $count }}</span>
                @empty
                    <span class="text-secondary small">No order data yet.</span>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-12 col-lg-6">
        <div class="card stat-card">
            <div class="card-header bg-white fw-semibold">Most Popular Menu Items</div>
            <ul class="list-group list-group-flush">
                @forelse($popularItems as $row)
                <li class="list-group-item d-flex justify-content-between">
                    {{ $row->menuItem->item_name ?? 'Unknown item' }}
                    <span class="badge bg-primary">{{ $row->total_sold }} sold</span>
                </li>
                @empty
                <li class="list-group-item text-secondary text-center">No sales data yet.</li>
                @endforelse
            </ul>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card stat-card">
            <div class="card-header bg-white fw-semibold">Low Stock Items</div>
            <ul class="list-group list-group-flush">
                @forelse($lowStockItems as $item)
                <li class="list-group-item d-flex justify-content-between">
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

<div class="card stat-card mt-3">
    <div class="card-header bg-white fw-semibold">Daily Sales (Last 7 Days)</div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead class="table-light"><tr><th>Date</th><th>Sales</th></tr></thead>
            <tbody>
                @forelse($dailySales as $row)
                <tr><td>{{ \Carbon\Carbon::parse($row->day)->format('d M Y') }}</td><td>Rs.{{ number_format($row->total, 2) }}</td></tr>
                @empty
                <tr><td colspan="2" class="text-center text-secondary py-3">No sales in this period.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('title', $customer->name)

@section('content')
<div class="card stat-card p-4 mb-3">
    <h5 class="mb-1">{{ $customer->name }}</h5>
    <div class="text-secondary small">{{ $customer->phone ?? '—' }} · {{ $customer->email ?? '—' }}</div>
    @if($customer->feedback)
    <div class="alert alert-light border mt-3 mb-0 small">{{ $customer->feedback }}</div>
    @endif
</div>

<div class="card stat-card">
    <div class="card-header bg-white fw-semibold">Order History</div>
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light"><tr><th>#</th><th>Table</th><th>Status</th><th>Total</th><th>Date</th></tr></thead>
            <tbody>
                @forelse($customer->orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->table->table_number ?? '—' }}</td>
                    <td><span class="badge {{ $order->statusBadgeClass() }}">{{ ucfirst($order->order_status) }}</span></td>
                    <td>${{ number_format($order->total_amount, 2) }}</td>
                    <td>{{ $order->order_date->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-secondary py-3">No orders yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

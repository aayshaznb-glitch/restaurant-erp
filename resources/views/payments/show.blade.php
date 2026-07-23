@extends('layouts.app')
@section('title', 'Invoice #'.$payment->id)

@section('content')
<div class="card stat-card p-4 mx-auto" style="max-width:600px;">
    <div class="text-center mb-3">
        <h5 class="mb-0">Restaurant ERP</h5>
        <div class="text-secondary small">Invoice #{{ $payment->id }}</div>
    </div>
    <hr>
    <div class="d-flex justify-content-between small mb-1"><span>Order #</span><span>{{ $payment->order_id }}</span></div>
    <div class="d-flex justify-content-between small mb-1"><span>Table</span><span>{{ $payment->order->table->table_number ?? '—' }}</span></div>
    <div class="d-flex justify-content-between small mb-1"><span>Cashier</span><span>{{ $payment->cashier->name ?? '—' }}</span></div>
    <div class="d-flex justify-content-between small mb-3"><span>Date</span><span>{{ $payment->created_at->format('d M Y, H:i') }}</span></div>
    <table class="table table-sm">
        <thead><tr><th>Item</th><th>Qty</th><th>Price</th><th>Subtotal</th></tr></thead>
        <tbody>
            @foreach($payment->order->items as $item)
            <tr>
                <td>{{ $item->menuItem->item_name ?? '—' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>Rs.{{ number_format($item->price, 2) }}</td>
                <td>Rs.{{ number_format($item->subtotal(), 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between small"><span>Subtotal</span><span>Rs.{{ number_format($payment->order->total_amount, 2) }}</span></div>
    <div class="d-flex justify-content-between small"><span>Discount</span><span>-Rs.{{ number_format($payment->discount, 2) }}</span></div>
    <div class="d-flex justify-content-between fs-5 fw-bold border-top pt-2 mt-2">
        <span>Total Paid</span><span>Rs.{{ number_format($payment->amount, 2) }}</span>
    </div>
    <div class="text-center mt-3">
        <span class="badge bg-secondary">{{ ucfirst($payment->payment_method) }}</span>
        <span class="badge bg-success">{{ ucfirst($payment->payment_status) }}</span>
    </div>
    <button class="btn btn-outline-secondary mt-3 d-print-none" onclick="window.print()"><i class="bi bi-printer"></i> Print</button>
</div>
@endsection

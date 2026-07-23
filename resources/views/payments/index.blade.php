@extends('layouts.app')
@section('title', 'Payments')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Payments</h5>
    <a href="{{ route('payments.create') }}" class="btn btn-danger btn-sm"><i class="bi bi-plus-lg"></i> New Invoice</a>
</div>

<div class="card stat-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Invoice #</th><th>Order</th><th>Table</th><th>Method</th><th>Amount</th><th>Cashier</th><th>Date</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>#{{ $payment->order_id }}</td>
                    <td>{{ $payment->order->table->table_number ?? '—' }}</td>
                    <td>{{ ucfirst($payment->payment_method) }}</td>
                    <td>Rs.{{ number_format($payment->amount, 2) }}</td>
                    <td>{{ $payment->cashier->name ?? '—' }}</td>
                    <td>{{ $payment->created_at->format('d M, H:i') }}</td>
                    <td class="text-end">
                        <a href="{{ route('payments.show', $payment) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-receipt"></i></a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-secondary py-3">No payments recorded yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $payments->links() }}</div>
@endsection

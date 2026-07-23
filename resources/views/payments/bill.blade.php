@extends('layouts.app')
@section('title', 'Generate Bill')

@section('content')
<div class="row g-3">
    <div class="col-12 col-lg-7">
        <div class="card stat-card p-4">
            <h5 class="mb-3">Order #{{ $order->id }} — Table {{ $order->table->table_number ?? '—' }}</h5>
            <table class="table align-middle">
                <thead class="table-light"><tr><th>Item</th><th>Qty</th><th>Price</th><th>Subtotal</th></tr></thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->menuItem->item_name ?? '—' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rs.{{ number_format($item->price, 2) }}</td>
                        <td>Rs.{{ number_format($item->subtotal(), 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-end fs-5 fw-bold">Order Total: Rs.{{ number_format($order->total_amount, 2) }}</div>
        </div>
    </div>

    <div class="col-12 col-lg-5">
        <div class="card stat-card p-4">
            <h6 class="mb-3">Payment Details</h6>
            <form method="POST" action="{{ route('payments.store') }}">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <div class="mb-3">
                    <label class="form-label">Payment Method</label>
                    <select name="payment_method" class="form-select" required>
                        <option value="cash">Cash</option>
                        <option value="card">Card</option>
                        <option value="online">Online Payment</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Discount (Rs)</label>
                    <input type="number" step="0.01" min="0" name="discount" id="discountInput" class="form-control" value="0">
                </div>
                <div class="d-flex justify-content-between fs-5 fw-bold mb-3">
                    <span>Payable:</span>
                    <span>Rs.<span id="payableAmount">{{ number_format($order->total_amount, 2) }}</span></span>
                </div>
                <button class="btn btn-danger w-100">Confirm Payment</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>

    const orderTotal = {{ $order-> total_amount }};
    const discountInput = document.getElementById('discountInput');
    const payableEl = document.getElementById('payableAmount');
    discountInput.addEventListener('input', () => {
        const discount = parseFloat(discountInput.value) || 0;
        payableEl.textContent = Math.max(orderTotal - discount, 0).toFixed(2);
    });
</script>
@endpush
@endsection

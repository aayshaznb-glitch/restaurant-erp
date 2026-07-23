<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['order.table', 'cashier'])->latest()->paginate(10);
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        // Orders that are served but not yet paid
        $orders = Order::whereIn('order_status', ['served', 'ready'])
            ->whereDoesntHave('payment')
            ->with(['table', 'items'])
            ->get();

        return view('payments.create', compact('orders'));
    }

    public function billFor(Order $order)
    {
        $order->load('items.menuItem');
        return view('payments.bill', compact('order'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => ['required', 'exists:orders,id'],
            'payment_method' => ['required', 'in:cash,card,online'],
            'discount' => ['nullable', 'numeric', 'min:0'],
        ]);

        $order = Order::with('items')->findOrFail($validated['order_id']);
        $discount = $validated['discount'] ?? 0;
        $amount = max($order->total_amount - $discount, 0);

        $payment = Payment::create([
            'order_id' => $order->id,
            'cashier_id' => $request->user()->id,
            'payment_method' => $validated['payment_method'],
            'amount' => $amount,
            'discount' => $discount,
            'payment_status' => 'paid',
        ]);

        $order->update(['order_status' => 'completed']);
        if ($order->table) {
            $order->table->update(['status' => 'cleaning']);
        }

        return redirect()->route('payments.index')->with('success', 'Invoice #'.$payment->id.' generated successfully.');
    }

    public function show(Payment $payment)
    {
        $payment->load('order.items.menuItem', 'order.table', 'cashier');
        return view('payments.show', compact('payment'));
    }
}

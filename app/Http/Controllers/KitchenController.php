<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class KitchenController extends Controller
{
    public function index()
    {
        $orders = Order::with(['table', 'items.menuItem'])
            ->whereIn('order_status', ['pending', 'confirmed', 'preparing', 'ready'])
            ->oldest('order_date')
            ->get();

        return view('kitchen.index', compact('orders'));
    }

    public function updateItemStatus(Request $request, OrderItem $orderItem)
    {
        $validated = $request->validate([
            'kitchen_status' => ['required', 'in:pending,preparing,ready'],
        ]);

        $orderItem->update($validated);

        $order = $orderItem->order;
        $statuses = $order->items()->pluck('kitchen_status');

        if ($statuses->every(fn ($s) => $s === 'ready')) {
            $order->update(['order_status' => 'ready']);
        } elseif ($statuses->contains('preparing')) {
            $order->update(['order_status' => 'preparing']);
        }

        return back()->with('success', 'Item status updated.');
    }
}

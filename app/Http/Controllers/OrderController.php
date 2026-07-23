<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['table', 'waiter', 'customer']);

        if ($request->filled('status')) {
            $query->where('order_status', $request->status);
        }

        $orders = $query->latest()->paginate(10)->withQueryString();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $tables = RestaurantTable::whereIn('status', ['available', 'reserved'])->orderBy('table_number')->get();
        $menuItems = MenuItem::where('status', 'available')->with('category')->orderBy('item_name')->get();
        $customers = Customer::orderBy('name')->get();

        return view('orders.create', compact('tables', 'menuItems', 'customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_id' => ['required', 'exists:restaurant_tables,id'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'special_instructions' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.menu_item_id' => ['required', 'exists:menu_items,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
        ]);

        $order = DB::transaction(function () use ($validated, $request) {
            $order = Order::create([
                'table_id' => $validated['table_id'],
                'customer_id' => $validated['customer_id'] ?? null,
                'waiter_id' => $request->user()->id,
                'special_instructions' => $validated['special_instructions'] ?? null,
                'order_status' => 'pending',
                'order_date' => now(),
            ]);

            foreach ($validated['items'] as $line) {
                $menuItem = MenuItem::findOrFail($line['menu_item_id']);
                $order->items()->create([
                    'menu_item_id' => $menuItem->id,
                    'quantity' => $line['quantity'],
                    'price' => $menuItem->price,
                ]);
            }

            $order->recalculateTotal();

            RestaurantTable::where('id', $validated['table_id'])->update(['status' => 'occupied']);

            return $order;
        });

        return redirect()->route('orders.show', $order)->with('success', 'Order created and sent to kitchen.');
    }

    public function show(Order $order)
    {
        $order->load(['items.menuItem', 'table', 'waiter', 'customer', 'payment']);
        return view('orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'order_status' => ['required', 'in:pending,confirmed,preparing,ready,served,completed,cancelled'],
        ]);

        $order->update(['order_status' => $validated['order_status']]);

        if (in_array($validated['order_status'], ['completed', 'cancelled']) && $order->table) {
            $order->table->update(['status' => 'cleaning']);
        }

        return back()->with('success', 'Order status updated to '.$validated['order_status'].'.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order removed.');
    }
}

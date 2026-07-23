<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $range = $request->get('range', 'weekly');

        $start = match ($range) {
            'daily' => now()->startOfDay(),
            'monthly' => now()->startOfMonth(),
            default => now()->subDays(7),
        };

        $salesTotal = Payment::where('payment_status', 'paid')->where('created_at', '>=', $start)->sum('amount');

        $ordersByStatus = Order::select('order_status', DB::raw('count(*) as total'))
            ->groupBy('order_status')
            ->pluck('total', 'order_status');

        $popularItems = OrderItem::select('menu_item_id', DB::raw('sum(quantity) as total_sold'))
            ->groupBy('menu_item_id')
            ->orderByDesc('total_sold')
            ->with('menuItem')
            ->take(5)
            ->get();

        $lowStockItems = InventoryItem::whereColumn('quantity', '<=', 'low_stock_threshold')->get();

        $dailySales = Payment::select(
            DB::raw('DATE(created_at) as day'),
            DB::raw('sum(amount) as total')
        )
            ->where('payment_status', 'paid')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        return view('reports.index', compact(
            'range', 'salesTotal', 'ordersByStatus', 'popularItems', 'lowStockItems', 'dailySales'
        ));
    }
}

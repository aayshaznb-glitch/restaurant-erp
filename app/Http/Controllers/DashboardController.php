<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\Payment;
use App\Models\RestaurantTable;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'todaysOrders' => Order::whereDate('order_date', today())->count(),
            'pendingOrders' => Order::whereIn('order_status', ['pending', 'confirmed', 'preparing'])->count(),
            'availableTables' => RestaurantTable::where('status', 'available')->count(),
            'totalTables' => RestaurantTable::count(),
            'totalMenuItems' => MenuItem::count(),
            'lowStockCount' => InventoryItem::whereColumn('quantity', '<=', 'low_stock_threshold')->count(),
            'todaysSales' => Payment::whereDate('created_at', today())->where('payment_status', 'paid')->sum('amount'),
            'monthlyRevenue' => Payment::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->where('payment_status', 'paid')
                ->sum('amount'),
            'recentOrders' => Order::with(['table', 'waiter'])->latest()->take(6)->get(),
            'lowStockItems' => InventoryItem::whereColumn('quantity', '<=', 'low_stock_threshold')->take(5)->get(),
        ];

        return view('dashboard', $data);
    }
}

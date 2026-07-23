<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin + Manager: menu, tables, users, suppliers, reports
    Route::middleware('role:admin,manager')->group(function () {
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('suppliers', SupplierController::class)->except(['show']);
        Route::resource('users', UserController::class)->except(['show']);
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });

    Route::middleware('role:admin,manager,waiter')->group(function () {
        Route::resource('menu-items', MenuItemController::class)->except(['show']);
        Route::resource('tables', TableController::class)->except(['show']);
        Route::patch('/tables/{table}/status', [TableController::class, 'updateStatus'])->name('tables.updateStatus');
        Route::resource('customers', CustomerController::class);
    });

    // Waiter: orders
    Route::middleware('role:admin,manager,waiter')->group(function () {
        Route::resource('orders', OrderController::class)->except(['edit', 'update']);
        Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    });

    // Kitchen staff
    Route::middleware('role:admin,manager,kitchen')->group(function () {
        Route::get('/kitchen', [KitchenController::class, 'index'])->name('kitchen.index');
        Route::patch('/kitchen/items/{orderItem}/status', [KitchenController::class, 'updateItemStatus'])->name('kitchen.updateItemStatus');
    });

    // Cashier: billing
    Route::middleware('role:admin,manager,cashier')->group(function () {
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
        Route::get('/payments/bill/{order}', [PaymentController::class, 'billFor'])->name('payments.bill');
        Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
        Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
    });

    // Inventory: admin, manager
    Route::middleware('role:admin,manager')->group(function () {
        Route::resource('inventory', InventoryController::class)->except(['show']);
    });
});

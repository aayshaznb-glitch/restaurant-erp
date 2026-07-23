<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\InventoryItem;
use App\Models\MenuItem;
use App\Models\RestaurantTable;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Demo users - one per role
        $roles = [
            ['name' => 'Admin User', 'email' => 'admin@restaurant.test', 'role' => 'admin'],
            ['name' => 'Manager User', 'email' => 'manager@restaurant.test', 'role' => 'manager'],
            ['name' => 'Waiter User', 'email' => 'waiter@restaurant.test', 'role' => 'waiter'],
            ['name' => 'Kitchen User', 'email' => 'kitchen@restaurant.test', 'role' => 'kitchen'],
            ['name' => 'Cashier User', 'email' => 'cashier@restaurant.test', 'role' => 'cashier'],
        ];

        foreach ($roles as $data) {
            User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                    'role' => $data['role'],
                    'status' => 'active',
                ]
            );
        }

        // Categories + menu items
        $menu = [
            'Pizza' => [
                ['name' => 'Margherita Pizza', 'price' => 8.99],
                ['name' => 'Pepperoni Pizza', 'price' => 10.49],
            ],
            'Burgers' => [
                ['name' => 'Classic Cheeseburger', 'price' => 6.99],
                ['name' => 'Double Beef Burger', 'price' => 9.49],
            ],
            'Drinks' => [
                ['name' => 'Fresh Orange Juice', 'price' => 2.49],
                ['name' => 'Iced Coffee', 'price' => 2.99],
            ],
            'Desserts' => [
                ['name' => 'Chocolate Brownie', 'price' => 3.99],
                ['name' => 'Ice Cream Sundae', 'price' => 3.49],
            ],
        ];

        foreach ($menu as $categoryName => $items) {
            $category = Category::firstOrCreate(['category_name' => $categoryName]);
            foreach ($items as $item) {
                MenuItem::firstOrCreate(
                    ['item_name' => $item['name']],
                    [
                        'category_id' => $category->id,
                        'price' => $item['price'],
                        'status' => 'available',
                    ]
                );
            }
        }

        // Tables
        for ($i = 1; $i <= 10; $i++) {
            RestaurantTable::firstOrCreate(
                ['table_number' => 'T'.str_pad($i, 2, '0', STR_PAD_LEFT)],
                ['capacity' => $i % 2 === 0 ? 4 : 2, 'status' => 'available']
            );
        }

        // Suppliers + inventory
        $supplier = Supplier::firstOrCreate(
            ['supplier_name' => 'Fresh Farms Supply'],
            ['phone' => '011-2345678', 'address' => 'Colombo, Sri Lanka']
        );

        $ingredients = [
            ['name' => 'Rice', 'qty' => 20, 'unit' => 'kg', 'threshold' => 5],
            ['name' => 'Chicken', 'qty' => 15, 'unit' => 'kg', 'threshold' => 5],
            ['name' => 'Vegetables', 'qty' => 4, 'unit' => 'kg', 'threshold' => 5],
            ['name' => 'Cheese', 'qty' => 8, 'unit' => 'kg', 'threshold' => 3],
        ];

        foreach ($ingredients as $ing) {
            InventoryItem::firstOrCreate(
                ['item_name' => $ing['name']],
                [
                    'supplier_id' => $supplier->id,
                    'quantity' => $ing['qty'],
                    'unit' => $ing['unit'],
                    'low_stock_threshold' => $ing['threshold'],
                ]
            );
        }
    }
}

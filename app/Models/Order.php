<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id', 'waiter_id', 'table_id', 'order_status',
        'total_amount', 'special_instructions', 'order_date',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
            'order_date' => 'datetime',
        ];
    }

    public const STATUSES = [
        'pending', 'confirmed', 'preparing', 'ready', 'served', 'completed', 'cancelled',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function waiter()
    {
        return $this->belongsTo(User::class, 'waiter_id');
    }

    public function table()
    {
        return $this->belongsTo(RestaurantTable::class, 'table_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function recalculateTotal(): void
    {
        $this->total_amount = $this->items()->sum(\Illuminate\Support\Facades\DB::raw('quantity * price'));
        $this->save();
    }

    public function statusBadgeClass(): string
    {
        return match ($this->order_status) {
            'pending' => 'bg-secondary',
            'confirmed' => 'bg-info text-dark',
            'preparing' => 'bg-warning text-dark',
            'ready' => 'bg-primary',
            'served' => 'bg-success',
            'completed' => 'bg-dark',
            'cancelled' => 'bg-danger',
            default => 'bg-secondary',
        };
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $fillable = [
        'supplier_id', 'item_name', 'quantity', 'unit', 'low_stock_threshold',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function getStockStatusAttribute(): string
    {
        return $this->quantity <= $this->low_stock_threshold ? 'low' : 'ok';
    }
}

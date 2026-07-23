<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['supplier_name', 'phone', 'address'];

    public function inventoryItems()
    {
        return $this->hasMany(InventoryItem::class);
    }
}

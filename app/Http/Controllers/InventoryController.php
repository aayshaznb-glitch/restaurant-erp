<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\Supplier;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = InventoryItem::with('supplier');

        if ($request->boolean('low_stock')) {
            $query->whereColumn('quantity', '<=', 'low_stock_threshold');
        }

        $items = $query->orderBy('item_name')->paginate(12)->withQueryString();

        return view('inventory.index', compact('items'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('supplier_name')->get();
        return view('inventory.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'item_name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'numeric', 'min:0'],
            'unit' => ['required', 'string', 'max:20'],
            'low_stock_threshold' => ['required', 'numeric', 'min:0'],
        ]);

        InventoryItem::create($validated);

        return redirect()->route('inventory.index')->with('success', 'Ingredient added to inventory.');
    }

    public function edit(InventoryItem $inventory)
    {
        $suppliers = Supplier::orderBy('supplier_name')->get();
        return view('inventory.edit', [
            'inventoryItem' => $inventory,
            'suppliers' => $suppliers,
        ]);
    }

    public function update(Request $request, InventoryItem $inventory)
    {
        $validated = $request->validate([
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'item_name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'numeric', 'min:0'],
            'unit' => ['required', 'string', 'max:20'],
            'low_stock_threshold' => ['required', 'numeric', 'min:0'],
        ]);

        $inventory->update($validated);

        return redirect()->route('inventory.index')->with('success', 'Inventory item updated.');
    }

    public function destroy(InventoryItem $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventory.index')->with('success', 'Inventory item removed.');
    }
}

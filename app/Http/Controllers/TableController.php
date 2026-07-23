<?php

namespace App\Http\Controllers;

use App\Models\RestaurantTable;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = RestaurantTable::orderBy('table_number')->paginate(12);
        return view('tables.index', compact('tables'));
    }

    public function create()
    {
        return view('tables.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_number' => ['required', 'string', 'max:50', 'unique:restaurant_tables'],
            'capacity' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:available,reserved,occupied,cleaning'],
        ]);

        RestaurantTable::create($validated);

        return redirect()->route('tables.index')->with('success', 'Table created successfully.');
    }

    public function edit(RestaurantTable $table)
    {
        return view('tables.edit', compact('table'));
    }

    public function update(Request $request, RestaurantTable $table)
    {
        $validated = $request->validate([
            'table_number' => ['required', 'string', 'max:50', 'unique:restaurant_tables,table_number,'.$table->id],
            'capacity' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:available,reserved,occupied,cleaning'],
        ]);

        $table->update($validated);

        return redirect()->route('tables.index')->with('success', 'Table updated successfully.');
    }

    public function destroy(RestaurantTable $table)
    {
        $table->delete();
        return redirect()->route('tables.index')->with('success', 'Table removed successfully.');
    }

    public function updateStatus(Request $request, RestaurantTable $table)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:available,reserved,occupied,cleaning'],
        ]);

        $table->update($validated);

        return back()->with('success', 'Table status updated.');
    }
}

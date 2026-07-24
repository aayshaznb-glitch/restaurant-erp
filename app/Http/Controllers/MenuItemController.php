<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index(Request $request)
    {
        $query = MenuItem::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $query->where('item_name', 'like', '%'.$request->search.'%');
        }

        $menuItems = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::orderBy('category_name')->get();

        return view('menu_items.index', compact('menuItems', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('category_name')->get();
        return view('menu_items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'item_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'in:available,unavailable'],
        ]);

        if ($request->hasFile('image')) {

    $image = $request->file('image');

    $imageName = time() . '.' . $image->getClientOriginalExtension();

    $image->move(public_path('uploads/menu-items'), $imageName);

    $validated['image'] = 'menu-items/' . $imageName;
}

        MenuItem::create($validated);

        return redirect()->route('menu-items.index')->with('success', 'Menu item added successfully.');
    }

    public function edit(MenuItem $menuItem)
    {
        $categories = Category::orderBy('category_name')->get();
        return view('menu_items.edit', compact('menuItem', 'categories'));
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'item_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'in:available,unavailable'],
        ]);

        if ($request->hasFile('image')) {

    $image = $request->file('image');

    $imageName = time() . '.' . $image->getClientOriginalExtension();

    $image->move(public_path('uploads/menu-items'), $imageName);

    $validated['image'] = 'menu-items/' . $imageName;
}

        $menuItem->update($validated);

        return redirect()->route('menu-items.index')->with('success', 'Menu item updated successfully.');
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();
        return redirect()->route('menu-items.index')->with('success', 'Menu item deleted successfully.');
    }
}

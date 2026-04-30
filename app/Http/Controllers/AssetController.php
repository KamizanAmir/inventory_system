<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::with(['category', 'activeLoan.user'])->get();
        return view('inventory.index', compact('assets'));
    }

    // Show the Add New Asset Form
    public function create()
    {
        // Grab all categories so we can put them in a dropdown menu
        $categories = Category::all();
        return view('inventory.create', compact('categories'));
    }

    // Save the new Asset to the database
    public function store(Request $request)
    {
        // 1. Validate the form data
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sku_label' => 'required|string|unique:assets,sku_label',
            'is_consumable' => 'boolean',
            'quantity' => 'nullable|integer|min:1',
            'min_stock_level' => 'nullable|integer|min:0',
        ]);

        $isConsumable = $request->has('is_consumable');

        // 2. Create the item
        Asset::create([
            'category_id' => $request->category_id,
            'sku_label' => strtoupper($request->sku_label), // Force uppercase for barcodes
            'is_consumable' => $isConsumable,
            'quantity' => $isConsumable ? $request->quantity : 1,
            'min_stock_level' => $isConsumable ? $request->min_stock_level : 0,
            'condition' => 'Good',
            'status' => 'In Store'
        ]);

        // 3. Send them back to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'New asset added to inventory!');
    }
}

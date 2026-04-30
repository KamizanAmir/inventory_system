<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Show the Add Category Form
    public function create()
    {
        return view('inventory.categories.create');
    }

    // Save the new Category to the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // The prefix must be unique so we don't accidentally mix up barcodes!
            'prefix' => 'required|string|max:5|unique:categories,prefix',
        ]);

        Category::create([
            'name' => $request->name,
            'prefix' => strtoupper($request->prefix), // Force it to be uppercase
        ]);

        return redirect()->route('dashboard')->with('success', 'New category "' . $request->name . '" created successfully!');
    }
}

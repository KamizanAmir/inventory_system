<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        // Fetch all assets, including their category name and any active loan info
        $assets = Asset::with(['category', 'activeLoan.user'])->get();

        return view('inventory.index', compact('assets'));
    }
}

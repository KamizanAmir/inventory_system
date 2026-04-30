<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    // Show the scanning page
    public function create()
    {
        return view('inventory.checkout');
    }

    // Handle the scanned barcode
    public function store(Request $request)
    {
        // 1. Validate the input
        $request->validate([
            'sku_label' => 'required|string'
        ]);

        // 2. Find the physical item in the database
        $asset = Asset::where('sku_label', $request->sku_label)->first();

        // 3. Safety checks
        if (!$asset) {
            return back()->with('error', 'Barcode not recognized in the system.');
        }

        if ($asset->condition == 'Broken' || $asset->condition == 'Needs Repair') {
            return back()->with('error', 'Warning: This item is damaged and cannot be checked out!');
        }

        // 4. Smart Scan Logic: Checkout or Check-in?
        if ($asset->status == 'In Store') {

            // It's in the store, so loan it out
            Loan::create([
                'asset_id' => $asset->id,
                // Note: We hardcode user_id 1 for now until you set up a login system!
                'user_id' => 1,
                'borrowed_at' => now(),
            ]);

            $asset->update(['status' => 'Loaned']);

            return back()->with('success', "Checked Out: {$asset->sku_label} ({$asset->category->name})");
        } elseif ($asset->status == 'Loaned') {

            // It's already loaned, so this scan means they are returning it
            $activeLoan = $asset->activeLoan;

            if ($activeLoan) {
                $activeLoan->update(['returned_at' => now()]);
            }

            $asset->update(['status' => 'In Store']);

            return back()->with('success', "Returned: {$asset->sku_label} is back in the store.");
        }

        return back()->with('error', 'Item is in an unknown state (Lost/Under Maintenance).');
    }
}

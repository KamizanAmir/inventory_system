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
            'sku_label' => 'required|string',
            'quantity' => 'nullable|integer|min:1' // The new quantity field
        ]);

        $takeQty = $request->quantity ?? 1;

        // 2. Find the physical item
        $asset = Asset::where('sku_label', $request->sku_label)->first();

        // 3. Safety checks
        if (!$asset) {
            return back()->with('error', 'Barcode not recognized in the system.');
        }

        if ($asset->condition == 'Broken' || $asset->condition == 'Needs Repair') {
            return back()->with('error', 'Warning: This item is damaged and cannot be checked out!');
        }

        // ==========================================
        // SCENARIO A: IT IS A CONSUMABLE (Cable, Battery)
        // ==========================================
        if ($asset->is_consumable) {

            if ($asset->quantity < $takeQty) {
                return back()->with('error', "Not enough stock! Only {$asset->quantity} left in store.");
            }

            // Deduct the inventory
            $asset->decrement('quantity', $takeQty);

            // Log who took it so we know which department used it
            Loan::create([
                'asset_id' => $asset->id,
                'user_id' => auth()->id(), // Uses the logged-in user!
                'borrowed_at' => now(),
                'location_notes' => "Withdrew {$takeQty} units."
            ]);

            return back()->with('success', "Checked Out: {$takeQty}x {$asset->category->name}. Remaining: {$asset->quantity}");
        }

        // ==========================================
        // SCENARIO B: IT IS A UNIQUE TOOL (Cangkul)
        // ==========================================
        if ($asset->status == 'In Store') {

            Loan::create([
                'asset_id' => $asset->id,
                'user_id' => auth()->id(), // Uses the logged-in user!
                'borrowed_at' => now(),
            ]);

            $asset->update(['status' => 'Loaned']);

            return back()->with('success', "Checked Out: {$asset->sku_label} ({$asset->category->name})");
        } elseif ($asset->status == 'Loaned') {

            $activeLoan = $asset->activeLoan;
            if ($activeLoan) {
                $activeLoan->update(['returned_at' => now()]);
            }
            $asset->update(['status' => 'In Store']);

            return back()->with('success', "Returned: {$asset->sku_label} is back in the store.");
        }

        return back()->with('error', 'Item is in an unknown state.');
    }
}

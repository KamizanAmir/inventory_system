<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Asset;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a dummy admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@inventory.local',
        ]);

        // 1. Create Categories
        $cangkul = Category::create(['name' => 'Cangkul', 'prefix' => 'CK']);
        $penyiram = Category::create(['name' => 'Penyiram Pokok', 'prefix' => 'PP']);
        $cabling = Category::create(['name' => 'Cabling', 'prefix' => 'CB']);

        // 2. Create Assets (The physical items)
        // Let's make 2 Cangkuls, 1 Penyiram, and 2 Cables
        Asset::create(['category_id' => $cangkul->id, 'sku_label' => 'CK-01', 'condition' => 'Good', 'status' => 'In Store']);
        Asset::create(['category_id' => $cangkul->id, 'sku_label' => 'CK-02', 'condition' => 'Needs Repair', 'status' => 'Under Maintenance']);

        Asset::create(['category_id' => $penyiram->id, 'sku_label' => 'PP-01', 'condition' => 'Good', 'status' => 'In Store']);

        Asset::create(['category_id' => $cabling->id, 'sku_label' => 'CB-01', 'condition' => 'Good', 'status' => 'Loaned']);
        Asset::create(['category_id' => $cabling->id, 'sku_label' => 'CB-02', 'condition' => 'Good', 'status' => 'In Store']);
    }
}

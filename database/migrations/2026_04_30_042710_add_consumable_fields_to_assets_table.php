<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            // Is this a bulk item (true) or a unique tool (false)?
            $table->boolean('is_consumable')->default(false)->after('sku_label');

            // How many do we have? (Defaults to 1 for unique tools)
            $table->integer('quantity')->default(1)->after('is_consumable');

            // At what quantity should this appear on the Procurement/Plan page?
            $table->integer('min_stock_level')->default(0)->after('quantity');
        });
    }

    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn(['is_consumable', 'quantity', 'min_stock_level']);
        });
    }
};

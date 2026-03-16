<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('purchase_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('product_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');     // prevent deleting product if used in purchases

            // Core fields
            $table->decimal('quantity', 15, 3)->default(0);     // more precision for fractional units
            $table->decimal('unit_cost', 15, 2)->default(0);    // renamed → clearer meaning
            $table->decimal('line_total', 15, 2)->default(0);   // renamed → clearer than just "total"

            // Optional / useful in many systems
            $table->decimal('discount_amount', 15, 2)->default(0)->nullable();
            $table->decimal('tax_amount', 15, 2)->default(0)->nullable();

            // Batch / expiry tracking (very common in pharmacies, food, etc.)
            $table->date('expiry_date')->nullable();
            $table->string('batch_number', 60)->nullable();

            // Audit / reference
            $table->timestamps();

            // Optional indexes (performance)
            $table->index(['purchase_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
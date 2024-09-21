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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key referencing products table
            $table->string('sku')->unique(); // Unique Stock Keeping Unit
            $table->text('description')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('pack_size'); // Pack_Size of this SKU in stock
            $table->date('expiry_date')->nullable(); // Expiry date for this stock item
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};

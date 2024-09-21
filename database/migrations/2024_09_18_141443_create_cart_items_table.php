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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->onDelete('cascade'); // Foreign key referencing carts table
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key referencing packages table
            $table->string('pack_size'); // Pack size of the product in the cart
            $table->decimal('price', 10, 2); // Price of the package at the time of adding to cart
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};

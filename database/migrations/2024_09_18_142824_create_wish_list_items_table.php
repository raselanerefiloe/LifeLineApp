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
        Schema::create('wish_list_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wish_list_id')->constrained()->onDelete('cascade'); // Foreign key referencing wish_lists table
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key referencing products table
            $table->integer('quantity'); // Quantity of the package in the wish list
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wish_list_items');
    }
};

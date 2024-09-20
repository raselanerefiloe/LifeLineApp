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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key referencing products table
            $table->string('package_name'); // Package description (e.g., "Box of 10 tablets")
            $table->decimal('price', 10, 2); // Price for the package
            $table->integer('quantity'); // Number of units in this package
            $table->string('image_url')->nullable(); // Image URL for the package
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'pack_size',
        'price',
        'image_url',
        'inStock',
    ];

    /**
     * Get the categories for the product.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
    public function isInStock()
    {
        // Check if there are any stock records for this product
        return $this->stocks()->exists() ? 1 : 0; // Returns 1 if in stock, else 0
    }
    public function stockQuantity()
    {
        $totalQuantity = 0;

        // Regex to match the quantity in pack_size
        $regex = '/(\d+)\s*(?:x|by)\s*\d*\s*[a-zA-Z]+/i';

        foreach ($this->stocks as $stock) {
            // Check if pack_size matches the regex
            if (preg_match($regex, $stock->pack_size, $matches)) {
                // Extract the quantity (first match)
                $quantity = (int)$matches[1]; // Cast to integer
                $totalQuantity += $quantity; // Sum the quantities
            }
        }

        return $totalQuantity;
    }

}

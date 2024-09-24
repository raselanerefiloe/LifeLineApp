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

}

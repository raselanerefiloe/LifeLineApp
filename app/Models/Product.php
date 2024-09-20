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
        'image_url',
        'manufacturer',
        'inStock',
    ];

    /**
     * Get the categories for the product.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }
    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}

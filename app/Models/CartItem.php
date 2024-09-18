<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    // The attributes that are mass assignable.
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price',
    ];

    // Define the relationship between CartItem and Cart
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Define the relationship between CartItem and Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

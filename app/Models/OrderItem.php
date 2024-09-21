<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    // The attributes that are mass assignable.
    protected $fillable = [
        'order_id',
        'product_id',
        'pack_size',
        'price',
    ];

    // Define the relationship between OrderItem and Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Define the relationship between OrderItem and Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

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
        'package_id',
        'quantity',
        'price',
    ];

    // Define the relationship between OrderItem and Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Define the relationship between OrderItem and Package
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}

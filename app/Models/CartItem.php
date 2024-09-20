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
        'package_id',
        'quantity',
        'price',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}

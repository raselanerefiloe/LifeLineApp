<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    // The attributes that are mass assignable.
    protected $fillable = [
        'user_id',
        'total',
    ];

    // Define the relationship between Cart and User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship between Cart and CartItem
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}

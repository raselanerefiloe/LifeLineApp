<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }


    // Method to calculate total
    public function updateTotal()
    {
        $this->total = $this->items()->get()->sum(function ($item) {
            // Extract quantity from pack_size
            preg_match('/(\d+)\s*(?:x|by)\s*\d*\s*[a-zA-Z]+/i', $item->pack_size, $matches);
            
            // Check if quantity is found
            $quantity = !empty($matches[1]) ? (int) $matches[1] : 0;
    
            // Return total for this item
            return $quantity * $item->price;
        });
    
        $this->save();
    }
}

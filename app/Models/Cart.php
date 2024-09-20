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
        $this->total = $this->items()->sum(DB::raw('quantity * price'));
        $this->save();
    }
}

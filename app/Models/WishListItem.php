<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishListItem extends Model
{
    use HasFactory;

    // The attributes that are mass assignable.
    protected $fillable = [
        'wish_list_id',
        'product_id',
        'quantity',
    ];

    // Define the relationship between WishListItem and WishList
    public function wishList()
    {
        return $this->belongsTo(WishList::class);
    }

    // Define the relationship between WishListItem and Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}

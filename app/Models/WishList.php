<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    use HasFactory;

    // The attributes that are mass assignable.
    protected $fillable = [
        'user_id',
        'total',
    ];

    // Define the relationship between WishList and User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship between WishList and WishListItem
    public function wishListItems()
    {
        return $this->hasMany(WishListItem::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    // The attributes that are mass assignable.
    protected $fillable = [
        'user_id',
        'total',
    ];

    // Define the relationship between Order and User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship between Order and OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function deliveryAddress()
    {
        return $this->hasOne(DeliveryAddress::class);
    }
    public function orderPayment()
    {
        return $this->hasOne(OrderPayment::class);
    }
}

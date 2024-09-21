<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'sku',
        'manufacturer',
        'description',
        'pack_size',
        'expiry_date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

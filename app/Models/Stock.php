<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_id',
        'sku',
        'quantity',
        'expiry_date',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}

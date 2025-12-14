<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'expiry_date',
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'discount_value' => 'decimal:2',
    ];
}

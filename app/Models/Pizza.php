<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'base_toppings',
        'additional_toppings',
        'small_price',
        'medium_price',
        'large_price',
    ];

    protected $casts = [
        'base_toppings' => 'array',
        'additional_toppings' => 'array',
    ];
}

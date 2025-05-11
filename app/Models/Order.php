<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
    ];

    /**
     * Get the items (pizzas) for this order.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

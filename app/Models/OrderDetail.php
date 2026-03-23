<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{

    protected $fillable = [
        'product_id',
        'order_id',
        'qty',
        'subtotal'
    ];

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    protected static function booted(): void
    {
        static::created(function ($orderDetail) {
            if ($orderDetail->order->status === 'completed') {
                $product = $orderDetail->product;

                if ($product) {
                    $product->decrement('stock', $orderDetail->qty);
                }
            }
        });
    }
}

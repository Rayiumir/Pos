<?php

namespace App\Models;

use App\Enum\Purchase\StatusPurchase;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{

    protected $fillable = [
        'purchase_id',
        'product_id',
        'purchase_unit',
        'qty',
        'total_qty',
        'price',
        'conversion',
        'subtotal'
    ];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function purchase(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    protected static function booted(): void
    {
        static::created(function ($purchase_detail) {
            if ($purchase_detail->purchase->status === 'done') {
                $product = $purchase_detail->product;
                if ($product) {
                    $product->decrement('stock', $purchase_detail->total_qty);
                }
            }
        });
    }
}

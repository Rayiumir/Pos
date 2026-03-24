<?php

namespace App\Models;

use App\Enum\Purchase\PaymentMethodPurchase;
use App\Enum\Purchase\PaymentPurchase;
use App\Enum\Purchase\StatusPurchase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;


class Purchase extends Model
{

    protected $fillable = [
        'purchase_number',
        'user_id',
        'supplier_id',
        'purchase_date',
        'received_date',
        'total_before_tax',
        'subtotal',
        'tax_rate',
        'tax_amount',
        'discount',
        'discount_amount',
        'total_payment',
        'status',
        'status_payment',
        'payment_method',
    ];

    protected $casts = [
        'status' => StatusPurchase::class,
        'status_payment' => PaymentPurchase::class,
        'payment_method' => PaymentMethodPurchase::class,
    ];

    public function supplier(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchase_details(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PurchaseDetail::class, 'purchase_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    protected static function booted(): void
    {

        static::updated(function ($purchase) {

            if ($purchase->isDirty('status') &&
                $purchase->status === StatusPurchase::Done) {
                foreach ($purchase->purchase_details as $row) {
                    $product = $row->product;
                    if ($product) {
                        $product->decrement('stock', $row->total_qty);
                    }
                }
            }

            if ($purchase->isDirty('status') &&
                $purchase->status === StatusPurchase::Canceled) {
                foreach ($purchase->purchase_details as $row) {
                    $product = $row->product;
                    if ($product) {
                        $product->increment('stock', $row->total_qty);
                    }
                }
            }

        });
    }

}

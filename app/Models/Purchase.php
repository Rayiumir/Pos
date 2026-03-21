<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'purchase_number',
        'user_id',
        'supplier_id',
        'purchase_date',
        'received_date',
        'subtotal',
        'tax_rate',
        'tax_amount',
        'discount',
        'discount_amount',
        'total_payment',
        'status_payment',
        'payment_method',
    ];
}

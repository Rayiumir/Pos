<?php

namespace App\Models;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Database\Eloquent\Model;

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
        'status_payment',
        'payment_method',
    ];

    public function supplier(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchase_details(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PurchaseDetail::class);
    }

}

enum Statuses: string implements HasLabel
{
    case Draft = 'draft';
    case Received = 'received';
    case Canceled = 'canceled';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Draft => 'پیش نویس',
            self::Received => 'در حال رسیدگی',
            self::Canceled => 'لغو شده',
        };
    }
}

enum PaymentStatuses: string implements HasLabel
{
    case Paid = 'paid';
    case Unpaid = 'unpaid';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Paid => 'پرداخت شده',
            self::Unpaid => 'پرداخت نشده',
        };
    }
}

enum PaymentMethodes: string implements HasLabel
{
    case Cash = 'cash';
    case Credit = 'credit';
    case Debit = 'debit';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Cash => 'پول نقد',
            self::Credit => 'کارت اعتباری',
            self::Debit => 'کارت نقدی',
        };
    }
}

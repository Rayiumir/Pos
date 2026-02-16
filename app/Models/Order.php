<?php

namespace App\Models;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'total_price',
        'date',
        'status',
        'discount',
        'discount_amount',
        'total_payment',
        'payment_status',
        'payment_method'
    ];

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}

enum Status: string implements HasLabel
{
    case New = 'new';
    case Processing = 'processing';
    case Canceled = 'canceled';
    case Completed = 'completed';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::New => 'جدید',
            self::Processing => 'در حال پردازش',
            self::Canceled => 'لغو شده',
            self::Completed => 'تکمیل شده',
        };
    }
}

enum PaymentStatus: string implements HasLabel
{
    case Paid = 'paid';
    case Unpaid = 'unpaid';
    case Failed = 'failed';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Paid => 'پرداخت شده',
            self::Unpaid => 'پرداخت نشده',
            self::Failed => 'ناموفق',
        };
    }
}

enum PaymentMethod: string implements HasLabel
{
    case Cash = 'cash';
    case Credit = 'credit';
    case Debit = 'debit';
    case Qr = 'qr';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Cash => 'پول نقد',
            self::Credit => 'کارت اعتباری',
            self::Debit => 'کارت نقدی',
            self::Qr => 'کیوآر کد',
        };
    }
}

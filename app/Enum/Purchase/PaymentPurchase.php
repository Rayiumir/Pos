<?php

namespace App\Enum\Purchase;

use Filament\Support\Contracts\HasLabel;

enum PaymentPurchase: string implements HasLabel
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

<?php

namespace App\Enum\Purchase;

use Filament\Support\Contracts\HasLabel;

enum PaymentMethodPurchase: string implements HasLabel
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

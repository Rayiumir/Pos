<?php

namespace App\Enum\Purchase;

use Filament\Support\Contracts\HasLabel;

enum StatusPurchase: string implements HasLabel
{
    case Draft = 'draft';
    case Done = 'done';
    case Received = 'received';
    case Canceled = 'canceled';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Draft => 'پیش نویس',
            self::Done => 'انجام شده',
            self::Received => 'در حال رسیدگی',
            self::Canceled => 'لغو شده',
        };
    }
}

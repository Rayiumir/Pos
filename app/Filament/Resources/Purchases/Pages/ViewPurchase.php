<?php

namespace App\Filament\Resources\Purchases\Pages;

use App\Filament\Resources\Purchases\PurchaseResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPurchase extends ViewRecord
{
    protected static string $resource = PurchaseResource::class;
    protected static ?string $title = 'مشاهده خرید کننده';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->icon('heroicon-o-pencil'),
        ];
    }
}

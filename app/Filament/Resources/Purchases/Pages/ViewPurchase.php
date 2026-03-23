<?php

namespace App\Filament\Resources\Purchases\Pages;

use App\Filament\Resources\Purchases\PurchaseResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPurchase extends ViewRecord
{
    protected static string $resource = PurchaseResource::class;
    protected static ?string $recordTitleAttribute = 'purchase_number';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->icon('heroicon-o-pencil-square'),

            Action::make('print')
                ->label('چاپ')
                ->icon('heroicon-o-printer')
                ->action(fn() => null)
                ->extraAttributes([
                    'onclick' => 'window.print(); return false;',
                ]),
        ];
    }
}

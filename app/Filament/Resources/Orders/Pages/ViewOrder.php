<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;
    protected static ?string $title = 'مشاهده سفارش';

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

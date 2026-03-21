<?php

namespace App\Filament\Resources\Suppliers\Pages;

use App\Filament\Resources\Suppliers\SupplierResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSuppliers extends ListRecords
{
    protected static string $resource = SupplierResource::class;
    protected static ?string $title = 'لیست تامین کننده';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('ایجاد تامین کننده جدید')
                ->icon('heroicon-o-plus'),
        ];
    }
}

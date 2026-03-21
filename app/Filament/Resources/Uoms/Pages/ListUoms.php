<?php

namespace App\Filament\Resources\Uoms\Pages;

use App\Filament\Resources\Uoms\UomResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUoms extends ListRecords
{
    protected static string $resource = UomResource::class;
    protected static ?string $title = 'لیست واحد اندازه گیری';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('افزودن واحد جدید')
                ->icon('heroicon-s-plus'),
        ];
    }
}

<?php

namespace App\Filament\Resources\BaseUnits\Pages;

use App\Filament\Resources\BaseUnits\BaseUnitResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBaseUnits extends ListRecords
{
    protected static string $resource = BaseUnitResource::class;
    protected static ?string $title = 'لیست واحد پایه';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('ایجاد واحد جدید')
                ->icon('heroicon-o-plus'),
        ];
    }
}

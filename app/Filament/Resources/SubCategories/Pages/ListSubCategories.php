<?php

namespace App\Filament\Resources\SubCategories\Pages;

use App\Filament\Resources\SubCategories\SubCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSubCategories extends ListRecords
{
    protected static string $resource = SubCategoryResource::class;
    protected static ?string $title = 'لیست زیر مجموعه دسته بندی';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('زیر مجموعه دسته بندی جدید')
                ->icon('heroicon-o-plus'),
        ];
    }
}

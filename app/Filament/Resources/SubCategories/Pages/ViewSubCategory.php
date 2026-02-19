<?php

namespace App\Filament\Resources\SubCategories\Pages;

use App\Filament\Resources\SubCategories\SubCategoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSubCategory extends ViewRecord
{
    protected static string $resource = SubCategoryResource::class;
    protected static ?string $title = 'مشاهده زیر مجموعه دسته بندی';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->icon('heroicon-o-pencil-square'),
        ];
    }
}

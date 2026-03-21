<?php

namespace App\Filament\Resources\BaseUnits\Pages;

use App\Filament\Resources\BaseUnits\BaseUnitResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBaseUnit extends CreateRecord
{
    protected static string $resource = BaseUnitResource::class;
    protected static ?string $title = 'ایجاد واحد جدید';
}

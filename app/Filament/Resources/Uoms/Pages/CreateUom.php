<?php

namespace App\Filament\Resources\Uoms\Pages;

use App\Filament\Resources\Uoms\UomResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUom extends CreateRecord
{
    protected static string $resource = UomResource::class;
    protected static ?string $title = 'ایجاد وارد اندازه گیری جدید';
}

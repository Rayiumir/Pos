<?php

namespace App\Filament\Resources\Suppliers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SupplierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('نام و نام خانوادگی')
                    ->required(),

                TextInput::make('phone')
                    ->label('شماره تلفن')
                    ->tel()
                    ->required(),

                TextInput::make('address')
                    ->label('آدرس')
                    ->required(),

                TextInput::make('cp_name')
                    ->label('شرکت تامین کننده')
                    ->required(),

                TextInput::make('cp_phone')
                    ->label('شماره تماس تامین کننده')
                    ->tel()
                    ->required(),

                TextInput::make('cp_email')
                    ->label('ایمیل تامین کننده')
                    ->email()
                    ->required(),

                Toggle::make('is_active')
                    ->label('فعال سازی')
                    ->required(),
            ]);
    }
}

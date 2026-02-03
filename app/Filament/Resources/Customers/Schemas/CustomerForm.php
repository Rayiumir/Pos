<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('نام و نام خانوادگی')
                    ->required(),
                TextInput::make('mobile')
                    ->label('موبایل')
                    ->required(),
                TextInput::make('phone')
                    ->label('تلفن')
                    ->tel()
                    ->default(null),
                Textarea::make('address')
                    ->label('آدرس')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}

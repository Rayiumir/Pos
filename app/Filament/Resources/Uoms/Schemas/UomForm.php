<?php

namespace App\Filament\Resources\Uoms\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UomForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('نام واحد')
                    ->required(),

                TextInput::make('code')
                    ->label('کد واحد')
                    ->required(),

                Select::make('base_unit_id')
                    ->relationship('baseUnits', 'name')
                    ->label('واحد پایه')
                    ->required(),

                TextInput::make('symbol')
                    ->label('نماد واحد')
                    ->required(),

                RichEditor::make('description')
                    ->label('توضیحات واحد')
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('فعال سازی')
                    ->required(),
            ]);
    }
}

<?php

namespace App\Filament\Resources\BaseUnits\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BaseUnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('نام')
                    ->required(),

                RichEditor::make('description')
                    ->label('توضیحات')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}

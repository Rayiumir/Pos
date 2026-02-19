<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('عنوان برند')
                    ->required(),
                FileUpload::make('image')
                    ->label('عکس برند')
                    ->image()
                    ->maxSize(2048)
                    ->directory('Pos\Brands'),
                Toggle::make('is_active')
                    ->label('فعال سازی')
                    ->required(),
            ]);
    }
}

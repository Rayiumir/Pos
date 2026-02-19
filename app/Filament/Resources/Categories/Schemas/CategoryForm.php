<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('عنوان دسته بندی')
                    ->required(),
                FileUpload::make('image')
                    ->label('عکس دسته بندی')
                    ->image()
                    ->maxSize(2048)
                    ->directory('Pos\Categories'),
                Toggle::make('is_active')
                    ->label('فعالسازی')
                    ->required(),
            ]);
    }
}

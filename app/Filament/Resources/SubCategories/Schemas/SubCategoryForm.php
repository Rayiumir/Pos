<?php

namespace App\Filament\Resources\SubCategories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SubCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('category_id')
                    ->label('شناسه دسته بندی')
                    ->required()
                    ->numeric(),
                TextInput::make('title')
                    ->label('عنوان دسته بندی')
                    ->required(),
                FileUpload::make('image')
                    ->label('عکس دسته بندی')
                    ->image(),
                Toggle::make('is_active')
                    ->label('فعالسازی')
                    ->required(),
            ]);
    }
}

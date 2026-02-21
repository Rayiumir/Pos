<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('عنوان محصول')
                    ->required(),
                TextInput::make('price')
                    ->label('قیمت محصول')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('stock')
                    ->label('موجودی در انبار')
                    ->required()
                    ->numeric(),
                FileUpload::make('image')
                    ->label('عکس محصول')
                    ->image(),
                Select::make('brand_id')
                    ->relationship('brand', 'title')
                    ->label('برند محصول')
                    ->default(null),
                Select::make('category_id')
                    ->relationship('category', 'title')
                    ->label('دسته بندی محصول')
                    ->default(null),
                Select::make('sub_category_id')
                    ->relationship('subCategory', 'title')
                    ->label('زیر دسته بندی محصول')
                    ->default(null),
                Toggle::make('is_active')
                    ->label('فعال بودن محصول')
                    ->required(),
                Toggle::make('in_stock')
                    ->label('موجود بودن محصول')
                    ->required(),
            ]);
    }
}

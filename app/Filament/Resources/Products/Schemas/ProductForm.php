<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\SubCategory;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
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

                TextInput::make('base_price')
                    ->label('قیمت اولیه')
                    ->required()
                    ->numeric()
                    ->prefix('$'),

                TextInput::make('price')
                    ->label('قیمت محصول')
                    ->required()
                    ->numeric()
                    ->prefix('$'),

                TextInput::make('barcode')
                    ->label('بارکد'),

                TextInput::make('SKU')
                    ->label('واحد نگهداری کالا'),

                TextInput::make('stock')
                    ->label('موجودی در انبار')
                    ->required()
                    ->numeric(),
                FileUpload::make('image')
                    ->label('عکس محصول')
                    ->image(),

                Select::make('brand_id')
                    ->label('برند محصول')
                    ->relationship('brand', 'title', fn($query) => $query->where('is_active', true)),

                Select::make('category_id')
                    ->relationship('category', 'title', fn($query) => $query->where('is_active', true))
                    ->reactive()
                    ->label('دسته بندی محصول'),

                Select::make('sub_category_id')
                    ->options(function (Get $get) {
                        $categoryId = $get('category_id');
                        if (!$categoryId) {
                            return [];
                        }

                        return SubCategory::where('category_id', $categoryId)
//                            ->where('is_active', true)
                            ->pluck('title', 'id');
                    })
                    ->reactive()
                    ->disabled(fn(callable $get) => $get('category_id') === null)
                    ->label('زیر دسته بندی محصول'),

                Toggle::make('is_active')
                    ->label('فعال بودن محصول')
                    ->required(),

                Toggle::make('in_stock')
                    ->label('موجود بودن محصول')
                    ->required(),

                RichEditor::make('description')
                    ->label('توضیحات محصول'),
            ]);
    }
}

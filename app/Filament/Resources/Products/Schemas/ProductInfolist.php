<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')
                    ->label('عنوان محصول'),
                TextEntry::make('price')
                    ->label('قیمت محصول')
                    ->money(),
                TextEntry::make('stock')
                    ->label('موجودی محصول')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->label('ایجاد شده در')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('به روزرسانی در')
                    ->dateTime()
                    ->placeholder('-'),
                ImageEntry::make('image')
                    ->label('عکس محصول')
                    ->placeholder('-'),
                TextEntry::make('brand.title')
                    ->label('برند محصول')
                    ->placeholder('-'),
                TextEntry::make('category.title')
                    ->label('دسته بندی')
                    ->placeholder('-'),
                TextEntry::make('subCategory.title')
                    ->label('زیر دسته بندی')
                    ->placeholder('-'),
                IconEntry::make('is_active')
                    ->label('فعال')
                    ->boolean(),
                IconEntry::make('in_stock')
                    ->label('موجودی در انبار')
                    ->boolean(),
            ]);
    }
}

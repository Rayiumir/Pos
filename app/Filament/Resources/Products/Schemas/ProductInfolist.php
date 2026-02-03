<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')->label('عنوان محصول'),
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
                    ->label('به روز رسانی در')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

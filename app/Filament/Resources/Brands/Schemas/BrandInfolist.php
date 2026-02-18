<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BrandInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')->label('عنوان برند'),
                ImageEntry::make('image')->label('عکس برند')
                    ->placeholder('-'),
                IconEntry::make('is_active')->label('فعال سازی')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('تاریخ به روزرسانی')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

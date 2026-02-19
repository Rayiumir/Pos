<?php

namespace App\Filament\Resources\SubCategories\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SubCategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('category.title')
                    ->label('شناسه دسته بندی')
                    ->numeric(),
                TextEntry::make('title')
                    ->label('عنوان دسته بندی'),
                ImageEntry::make('image')
                    ->label('عکس دسته بندی')
                    ->placeholder('-'),
                IconEntry::make('is_active')
                    ->label('فعالسازی')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->label('ایجاد شده در')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('به روزرسانی در')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

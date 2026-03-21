<?php

namespace App\Filament\Resources\Uoms\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UomInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('نام واحد'),

                TextEntry::make('code')
                    ->label('کد واحد'),

                TextEntry::make('baseUnits.name')
                    ->label('واحد پایه'),

                TextEntry::make('symbol')
                    ->label('نماد واحد'),

                TextEntry::make('description')
                    ->label('توضیحات')
                    ->columnSpanFull(),

                IconEntry::make('is_active')
                    ->label('فعال سازی')
                    ->boolean(),

                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),

                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

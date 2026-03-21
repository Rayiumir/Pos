<?php

namespace App\Filament\Resources\BaseUnits\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BaseUnitInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('نام'),

                TextEntry::make('description')
                    ->label('نام')
                    ->columnSpanFull(),

                TextEntry::make('created_at')
                    ->label('ایجاد شده در')
                    ->dateTime()
                    ->placeholder('-'),

                TextEntry::make('updated_at')
                    ->label('به روز شده در')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

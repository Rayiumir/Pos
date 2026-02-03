<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('customer_id')
                    ->label('شناسه مشتری')
                    ->numeric(),
                TextEntry::make('total_price')
                    ->label('قیمت کل')
                    ->money(),
                TextEntry::make('date')
                    ->label('تاریخ سفارش')
                    ->date(),
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

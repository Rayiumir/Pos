<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->label('نام مشتری'),
                TextInput::make('total_price')
                    ->label('قیمت کل')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                DatePicker::make('date')
                    ->label('تاریخ سفارش')
                    ->required(),
            ]);
    }
}

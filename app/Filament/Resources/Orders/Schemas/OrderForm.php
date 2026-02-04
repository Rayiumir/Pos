<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Customer;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->description('اطلاعات مشتری')
                    ->schema([
                        Select::make('customer_id')
                            ->relationship('customer', 'name')
                            ->label('نام مشتری')
                            ->reactive()
                        ->afterStateUpdated(function ($state, Set $set){
                            $customer = Customer::find($state);
                            $set('mobile', $customer->mobile ?? null);
                            $set('phone', $customer->phone ?? null);
                            $set('address', $customer->address ?? null);
                        }),
                        TextInput::make('mobile')
                            ->label('موبایل')
                            ->disabled(),
                        TextInput::make('phone')
                            ->label('تلفن')
                        ->disabled(),
                        TextInput::make('address')
                            ->label('آدرس')
                        ->disabled(),
                    ])->columns(2),
                Section::make()
                    ->schema([
                        TextInput::make('total_price')
                            ->label('قیمت کل')
                            ->required()
                            ->numeric()
                            ->prefix('$'),
                        DatePicker::make('date')
                            ->required()
                            ->disabled()
                            ->hiddenLabel()
                            ->prefix('تاریخ سفارش:'),
                    ]),
            ]);
    }
}

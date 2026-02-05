<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Customer;
use App\Models\Product;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Tiptap\Nodes\Text;

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
                        Textarea::make('address')
                            ->label('آدرس')
                        ->disabled(),
                    ])->columns(2),
                Section::make()
                ->schema([
                    Repeater::make('orderdetail')
                        ->relationship()
                        ->label('جزئیات سفارش')
                        ->schema([
                            Select::make('product_id')
                            ->label('نام محصول')
                            ->relationship('product', 'title')
                                ->reactive()
                            ->afterStateUpdated(function ($state, Set $set, Get $get){
                                $product = Product::find($state);
                                $price = $product->price ?? 0;
                                $set('price', $price);
                                $qty = $get('qty') ?? 1;
                                $set('qty', $qty);
                                $subtotal = $price * $qty;
                                $set('subtotal', $subtotal);

                                $items = $get('../../orderdetail') ?? [];
                                $total = collect($items)->sum(fn($item) => $item['subtotal'] ?? 0);
                                $set('../../total_price', $total);

                            }),
                            TextInput::make('price')
                                ->label('قیمت محصول'),
                            TextInput::make('qty')
                            ->label('تعداد محصول')
                            ->numeric()
                            ->default(1)
                            ->reactive()
                            ->afterStateUpdated(function ($state, Set $set, Get $get){
                                $price = $get('price') ?? 0;
                                $set('subtotal', $price * $state);

                                $items = $get('../../orderdetail') ?? [];
                                $total = collect($items)->sum(fn($item) => $item['subtotal'] ?? 0);
                                $set('../../total_price', $total);
                            }),
                            TextInput::make('subtotal')
                            ->label('جمع جزء')
                        ])->columns(2),
                    ]),
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
                            ->dehydrated()
                            ->default(now())
                            ->prefix('تاریخ سفارش:'),
                    ]),
            ]);
    }
}

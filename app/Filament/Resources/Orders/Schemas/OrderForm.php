<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Customer;
use App\Models\Product;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
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
                    ->columnSpanFull()
                    ->columns(4)
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
                        Placeholder::make('mobile')
                            ->label('موبایل')
                            ->content(fn(Get $get) => Customer::find($get('customer_id'))?->mobile ?? '-'),
                        Placeholder::make('phone')
                            ->label('تلفن')
                        ->content(fn(Get $get) => Customer::find($get('customer_id'))?->phone ?? '-'),
                        Placeholder::make('address')
                            ->label('آدرس')
                            ->content(fn(Get $get) => Customer::find($get('customer_id'))?->address ?? '-'),
                    ]),
                Section::make()
                    ->columnSpanFull()
                    ->schema([
                        Repeater::make('orderdetails')
                        ->relationship()
                        ->label('جزئیات سفارش')
                            ->columns(4)
                        ->schema([
                            Select::make('product_id')
                            ->label('نام محصول')
                            ->relationship('product', 'title')
                            ->reactive()
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                            ->afterStateUpdated(function ($state, Set $set, Get $get){
                                $product = Product::find($state);
                                $price = $product->price ?? 0;
                                $set('price', $price);
                                $qty = $get('qty') ?? 1;
                                $set('qty', $qty);
                                $subtotal = $price * $qty;
                                $set('subtotal', $subtotal);

                                $items = $get('../../orderdetails') ?? [];
                                $total = collect($items)->sum(fn($item) => $item['subtotal'] ?? 0);
                                $set('../../total_price', $total);

                            }),
                            TextInput::make('price')
                                ->label('قیمت محصول')
                                ->disabled()
                                ->readOnly()
                                ->numeric()
                                ->formatStateUsing(fn($state, Get $get) => $state ?? Product::find($get('product_id'))?->price ?? 0),
                            TextInput::make('qty')
                            ->label('تعداد محصول')
                            ->numeric()
                            ->default(1)
                            ->reactive()
                            ->afterStateUpdated(function ($state, Set $set, Get $get){
                                $price = $get('price') ?? 0;
                                $set('subtotal', $price * $state);

                                $items = $get('../../orderdetails') ?? [];
                                $total = collect($items)->sum(fn($item) => $item['subtotal'] ?? 0);
                                $set('../../total_price', $total);
                            }),
                            TextInput::make('subtotal')
                            ->label('جمع جزء')
                                ->disabled()
                                ->dehydrated(),
                        ]),
                    ]),
                Section::make()
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('total_price')
                            ->label('قیمت کل')
                            ->disabled()
                            ->dehydrated()
                            ->prefix('$'),
                        DatePicker::make('date')
                            ->disabled()
                            ->hiddenLabel()
                            ->dehydrated()
                            ->default(now())
                            ->prefix('تاریخ سفارش:'),
                    ]),
            ]);
    }
}

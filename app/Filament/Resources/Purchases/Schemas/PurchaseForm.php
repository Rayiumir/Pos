<?php

namespace App\Filament\Resources\Purchases\Schemas;

use App\Models\PaymentMethodes;
use App\Models\PaymentStatuses;
use App\Models\Product;
use App\Models\Statuses;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class PurchaseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('purchase_number')
                            ->disabled()
                            ->hiddenLabel()
                            ->dehydrated()
                            ->prefix('شماره خرید :'),

                        Select::make('user_id')
                            ->hiddenLabel()
                            ->dehydrated()
                            ->prefix('توسط کاربر : ')
                            ->default(Auth::id())
                            ->options([Auth::id() => Auth::user()->name]),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make()
                    ->schema([
                        Fieldset::make('اطلاعات خرید')
                            ->schema([
                                Select::make('supplier_id')
                                    ->relationship('supplier', 'name')
                                    ->label('تامین کننده')
                                    ->required(),

                                DatePicker::make('purchase_date')
                                    ->label('تاریخ خرید'),

                                DatePicker::make('received_date')
                                    ->label('تاریخ رسید'),
                            ])->columns(1),

                        Fieldset::make('جزئیات خرید')
                            ->schema([
                                Repeater::make('purchase_details')
                                ->relationship('purchase_details')
                                    ->hiddenLabel()
                                    ->schema([
                                        Select::make('product_id')
                                            ->label('نام محصول')
                                            ->relationship('product', 'title')
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                                $product = Product::find($state);
                                                if ($product) {
                                                    $set('purchase_unit', $product->PurchaseUnit->name);
                                                    $set('conversion', $product->conversion_factor);
//                                                    $set('base_unit', $product->BaseUnit->code);
                                                } else {
                                                    $set('purchase_unit', null);
                                                    $set('conversion', null);
                                                    $set('total_qty', null);
//                                                    $set('base_unit', null);
                                                    $set('price', null);
                                                }
                                            }),

                                        TextInput::make('qty')
                                            ->label('تعداد')
                                            ->numeric()
                                            ->reactive()
                                            ->default(1)
                                            ->minValue(1)
                                            ->afterStateUpdated(function ($state ,callable $set, callable $get) {
                                                $conversion = $get('conversion') ?? 1;
                                                $Price = $get('price') ?? 0;
                                                $set('subtotal', $state * $Price);
                                                $set('total_qty', $state * $conversion);

                                                $items = $get('../../purchase_details') ?? [];
                                                $total = collect($items)->sum(fn($item) => $item['subtotal'] ?? 0);
                                                $set('../../total_before_tax', $total);

                                                $tax_rate = $get('../../tax_rate') ?? 11;
                                                $taxAmount = ($tax_rate / 100) * $total;
                                                $set('../../tax_amount', $taxAmount);

                                                $discount_rate = $get('../../discount') ?? 0;
                                                $discountAmount = ($discount_rate / 100) * $total;
                                                $set('../../discount_amount', $discountAmount);

                                                $set('../../total_payment', $total + $taxAmount - $discountAmount);
                                            }),

                                        TextInput::make('purchase_unit')
                                            ->label('واحد خرید')
                                            ->disabled(),

                                        TextInput::make('price')
                                            ->label('قیمت محصول')
                                            ->prefix('$')
                                            ->reactive()
                                            ->afterStateUpdated(function ($state ,callable $set, callable $get) {

                                                $Qty = $get('qty') ?? 1;
                                                $set('subtotal', $Qty * $state);

                                                $items = $get('../../purchase_details') ?? [];
                                                $total = collect($items)->sum(fn($item) => $item['subtotal'] ?? 0);
                                                $set('../../total_before_tax', $total);

                                                $tax_rate = $get('../../tax_rate') ?? 11;
                                                $taxAmount = ($tax_rate / 100) * $total;
                                                $set('../../tax_amount', $taxAmount);

                                                $discount_rate = $get('../../discount') ?? 0;
                                                $discountAmount = ($discount_rate / 100) * $total;
                                                $set('../../discount_amount', $discountAmount);

                                                $set('../../total_payment', $total + $taxAmount - $discountAmount);

                                            }),

                                        TextInput::make('conversion')
                                            ->label('ضریب تبدیل')
                                            ->disabled(),

                                        TextInput::make('total_qty')
                                            ->label('تعداد کل')
                                            ->disabled(),

                                        TextInput::make('subtotal')
                                            ->label('جمع کل')
                                            ->disabled()
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpanFull()
                                    ->columns(2)
                            ]),

                    ]),

                Section::make()
                    ->schema([
                        Fieldset::make('اطلاعات پرداختی')
                            ->schema([
                                TextInput::make('total_before_tax')
                                ->label('قبل از کل مالیات')
                                    ->disabled()
                                    ->required()
                                    ->numeric(),

                                TextInput::make('tax_rate')
                                    ->label('درصد مالیات')
                                    ->default('11')
                                    ->required()
                                    ->numeric()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                        $total = $get('total_before_tax');
                                        $taxAmount = ($state / 100) * $total;
                                        $set('tax_amount', $taxAmount);

                                        $discount = $get('discount') ?? 0;
                                        $discountAmount = ($discount / 100) * $total;
                                        $set('discount_amount', $discountAmount);

                                        $set('total_payment', $total + $taxAmount - $discountAmount);
                                    }),

                                TextInput::make('tax_amount')
                                    ->label('مبلغ مالیات')
                                    ->disabled()
                                    ->required()
                                    ->numeric()
                                    ->readOnly(),

                                TextInput::make('discount')
                                    ->label('درصد تخفیف')
                                    ->required()
                                    ->numeric()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state ,callable $set, callable $get) {
                                        $total = $get('total_before_tax');

                                        $tax_rate = $get('tax_rate') ?? 11;
                                        $taxAmount = ($tax_rate / 100) * $total;
                                        $set('tax_amount', $taxAmount);

                                        $discountAmount = ($state / 100) * $total;
                                        $set('discount_amount', $discountAmount);

                                        $set('total_payment', $total + $taxAmount - $discountAmount);
                                    }),

                                TextInput::make('discount_amount')
                                    ->label('مبلغ تخفیف')
                                    ->disabled()
                                    ->required()
                                    ->numeric()
                                    ->readOnly(),

                                TextInput::make('total_payment')
                                    ->label('کل پرداختی')
                                    ->disabled()
                                    ->required()
                                    ->numeric()
                                    ->readOnly(),

                                Select::make('status')
                                    ->label('وضعیت')
                                    ->options(Statuses::class)
                                    ->default('draft')
                                    ->required(),

                                Select::make('status_payment')
                                    ->label('وضعیت پرداختی')
                                    ->options(PaymentStatuses::class)
                                    ->required(),

                                Select::make('payment_method')
                                    ->label('درگاه پرداخت')
                                    ->options(PaymentMethodes::class)
                                    ->default('cash')
                                    ->required(),
                            ])->columns(3),
                    ]),
            ]);
    }
}

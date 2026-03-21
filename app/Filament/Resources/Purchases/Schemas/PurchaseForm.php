<?php

namespace App\Filament\Resources\Purchases\Schemas;

use App\Models\PaymentMethodes;
use App\Models\PaymentStatuses;
use App\Models\Statuses;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

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

                        TextInput::make('user_id')
                            ->disabled()
                            ->hiddenLabel()
                            ->dehydrated()
                            ->prefix('توسط کاربر : '),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make()
                    ->schema([
                        Fieldset::make('اطلاعات خرید')
                            ->schema([
                                Select::make('supplier_id')
                                    ->label('تامین کننده')
                                    ->required(),

                                DatePicker::make('purchase_date')
                                    ->label('تاریخ خرید'),

                                DatePicker::make('received_date')
                                    ->label('تاریخ رسید'),
                            ])->columns(1),
                ]),

                Section::make()
                    ->schema([
                        Fieldset::make('اطلاعات پرداختی')
                            ->schema([
                                TextInput::make('subtotal')
                                    ->label('جمع کل')
                                    ->disabled()
                                    ->required()
                                    ->numeric(),

                                TextInput::make('tax_rate')
                                    ->label('درصد مالیات')
                                    ->default('11')
                                    ->disabled()
                                    ->required()
                                    ->numeric(),

                                TextInput::make('tax_amount')
                                    ->label('مبلبغ مالیات')
                                    ->disabled()
                                    ->required()
                                    ->numeric(),

                                TextInput::make('discount')
                                    ->label('درصد تخفیف')
                                    ->required()
                                    ->numeric(),

                                TextInput::make('discount_amount')
                                    ->label('مبلغ تخفیف')
                                    ->disabled()
                                    ->required()
                                    ->numeric(),

                                TextInput::make('total_payment')
                                    ->label('کل پرداختی')
                                    ->disabled()
                                    ->required()
                                    ->numeric(),

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

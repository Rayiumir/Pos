<?php

namespace App\Filament\Resources\Purchases\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use PHPUnit\Metadata\Group;

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
                                TextInput::make('supplier_id')
                                    ->label('تامین کننده')
                                    ->required()
                                    ->numeric(),

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
                                    ->required()
                                    ->numeric(),

                                TextInput::make('tax_rate')
                                    ->label('درصد مالیات')
                                    ->required()
                                    ->numeric(),

                                TextInput::make('tax_amount')
                                    ->label('مبلبغ مالیات')
                                    ->required()
                                    ->numeric(),

                                TextInput::make('discount')
                                    ->label('درصد تخفیف')
                                    ->required()
                                    ->numeric(),

                                TextInput::make('discount_amount')
                                    ->label('مبلغ تخفیف')
                                    ->required()
                                    ->numeric(),

                                TextInput::make('total_payment')
                                    ->label('کل پرداختی')
                                    ->required()
                                    ->numeric(),

                                Select::make('status')
                                    ->label('وضعیت')
                                    ->options(['draft' => 'Draft', 'received' => 'Received', 'canceled' => 'Canceled'])
                                    ->default('draft')
                                    ->required(),

                                Select::make('status_payment')
                                    ->label('وضعیت پرداختی')
                                    ->options(['paid' => 'Paid', 'unpaid' => 'Unpaid'])
                                    ->required(),

                                Select::make('payment_method')
                                    ->label('درگاه پرداخت')
                                    ->options(['cash' => 'Cash', 'credit' => 'Credit', 'debit' => 'Debit'])
                                    ->default('cash')
                                    ->required(),
                            ])->columns(3),
                ]),
            ]);
    }
}

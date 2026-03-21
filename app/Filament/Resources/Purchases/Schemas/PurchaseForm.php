<?php

namespace App\Filament\Resources\Purchases\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PurchaseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('purchase_number')
                    ->label('شماره خرید')
                    ->required(),

                TextInput::make('user_id')
                    ->label('کاربر')
                    ->required()
                    ->numeric(),

                TextInput::make('supplier_id')
                    ->label('تامین کننده')
                    ->required()
                    ->numeric(),

                DatePicker::make('purchase_date')
                    ->label('تاریخ خرید'),

                DatePicker::make('received_date')
                    ->label('تاریخ رسید'),

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
            ]);
    }
}

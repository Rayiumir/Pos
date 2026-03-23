<?php

namespace App\Filament\Resources\Purchases\Schemas;

use App\Models\PaymentMethod;
use App\Models\PaymentStatuses;
use App\Models\StatusPurchase;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;

class PurchaseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Fieldset::make('جزئیات سفارش')
                            ->schema([
                                TextEntry::make('purchase_number')
                                    ->label('شماره خرید'),

                                TextEntry::make('user.name')
                                    ->label('توسط کاربر'),

                                TextEntry::make('supplier.name')
                                    ->label('تامین کننده'),

                                TextEntry::make('purchase_date')
                                    ->label('تاریخ خرید')
                                    ->date()
                                    ->placeholder('-'),

                                TextEntry::make('received_date')
                                    ->label('تاریخ رسیدگی')
                                    ->date()
                                    ->placeholder('-'),

                            ])->columns(5)
                    ])->columnSpanFull(),

                Section::make()
                    ->schema([
                        Fieldset::make('اطلاعات خرید محصول')

                            ->schema([

                                TextEntry::make('product.title')
                                    ->label('نام محصول')


                            ])->columns(5)
                    ])->columnSpanFull(),

                Section::make()
                    ->schema([
                        Fieldset::make('جزئیات مالی و وضعیت پرداخت')
                            ->schema([

                                TextEntry::make('subtotal')
                                    ->label('جمع کل'),

                                TextEntry::make('tax_rate')
                                    ->label('درصد مالیات'),

                                TextEntry::make('tax_amount')
                                    ->label('مبلغ مالیات'),

                                TextEntry::make('discount')
                                    ->label('تخفیف'),

                                TextEntry::make('discount_amount')
                                    ->label('مبلغ تخفیف'),

                                TextEntry::make('total_payment')
                                    ->label('کل پرداختی'),

                                TextEntry::make('status')
                                    ->label('وضعیت')
                                    ->badge()
                                    ->formatStateUsing(fn($state) => StatusPurchase::from($state)),

                                TextEntry::make('status_payment')
                                    ->label('وضعیت پرداختی')
                                    ->badge()
                                    ->formatStateUsing(fn($state) => PaymentStatuses::from($state)),

                                TextEntry::make('payment_method')
                                    ->label('درگاه پرداختی')
                                    ->badge()
                                    ->formatStateUsing(fn($state) => PaymentMethod::from($state)),

                            ])->columns(3)
                    ])->columnSpanFull(),

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

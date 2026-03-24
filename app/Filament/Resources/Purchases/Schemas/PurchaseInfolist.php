<?php

namespace App\Filament\Resources\Purchases\Schemas;

use App\Enum\Purchase\PaymentMethodPurchase;
use App\Enum\Purchase\PaymentPurchase;
use App\Enum\Purchase\StatusPurchase;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;


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
                        Fieldset::make('جزئیات محصول')

                            ->schema([

                                RepeatableEntry::make('purchase_details')
                                    ->hiddenLabel()
                                    ->schema([
                                        ImageEntry::make('product.image')
                                            ->label('عکس محصول')
                                        ->imageWidth('6rem')
                                        ->imageHeight('4rem'),

                                        TextEntry::make('product.title')
                                            ->label('نام محصول'),

                                        TextEntry::make('price')
                                            ->label('قیمت محصول'),

                                        TextEntry::make('qty')
                                            ->label('تعداد '),

                                        TextEntry::make('total_qty')
                                            ->label('تعداد کل '),

                                        TextEntry::make('purchase_unit')
                                            ->label('واحد خرید'),

                                        TextEntry::make('subtotal')
                                            ->label('جمع کل'),


                                    ])->columnSpanFull()->columns(4),

                            ])
                    ])->columnSpanFull(),

                Section::make()
                    ->schema([
                        Fieldset::make('جزئیات مالی و وضعیت پرداخت')
                            ->schema([

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
                                    ->formatStateUsing(fn(StatusPurchase $state) => $state->getLabel()),

                                TextEntry::make('status_payment')
                                    ->label('وضعیت پرداختی')
                                    ->badge()
                                    ->formatStateUsing(fn(PaymentPurchase $state) => $state->getLabel()),

                                TextEntry::make('payment_method')
                                    ->label('درگاه پرداختی')
                                    ->badge()
                                    ->formatStateUsing(fn(PaymentMethodPurchase $state) => $state->getLabel()),

                            ])->columns(4)
                    ])->columnSpanFull(),

                Section::make()
                    ->schema([
                        Fieldset::make('تاریخ ثبت خرید')
                            ->schema([

                                TextEntry::make('created_at')
                                    ->label('ایجاد شده در')
                                    ->dateTime()
                                    ->placeholder('-'),

                                TextEntry::make('updated_at')
                                    ->label('به روز شده در')
                                    ->dateTime()
                                    ->placeholder('-'),

                            ])->columns(2)
                    ])->columnSpanFull(),

            ]);
    }
}

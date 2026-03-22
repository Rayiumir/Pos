<?php

namespace App\Filament\Resources\Purchases\Schemas;

use App\Models\PaymentMethod;
use App\Models\PaymentStatuses;
use App\Models\StatusPurchase;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class PurchaseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('purchase_number')
                    ->label('شماره خرید'),

                TextEntry::make('user_id')
                    ->label('توسط کاربر')
                    ->default(Auth::id())
                    ->formatStateUsing(function ($state) {

                        if (Auth::id() === $state) {
                            return Auth::user()->name;
                        }

                        return $state;

                    }),

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

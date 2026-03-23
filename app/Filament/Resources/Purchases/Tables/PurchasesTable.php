<?php

namespace App\Filament\Resources\Purchases\Tables;

use App\Models\PaymentMethod;
use App\Models\PaymentStatuses;
use App\Models\Statuses;
use App\Models\StatusPurchase;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class PurchasesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('purchase_number')
                    ->label('شماره خرید')
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('کاربر ایجاد کننده')
                    ->sortable(),

                TextColumn::make('supplier.name')
                    ->label('تامین کننده')
                    ->sortable(),

                TextColumn::make('purchase_date')
                    ->label('تاریخ خرید')
                    ->date()
                    ->sortable(),

                TextColumn::make('received_date')
                    ->label('تاریخ رسید')
                    ->date()
                    ->sortable(),

                TextColumn::make('subtotal')
                    ->label('جمع کل')
                    ->sortable(),

                TextColumn::make('tax_rate')
                    ->label('درصد مالیات')
                    ->sortable(),

                TextColumn::make('tax_amount')
                    ->label('مبلغ مالیات')
                    ->sortable(),

                TextColumn::make('discount')
                    ->label('درصد تخفیف')
                    ->sortable(),

                TextColumn::make('discount_amount')
                    ->label('مبلغ تخفیف')
                    ->sortable(),

                TextColumn::make('total_payment')
                    ->label('کل پرداختی')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('وضعیت')
                    ->badge()
                    ->formatStateUsing(fn($state) => StatusPurchase::from($state)),

                TextColumn::make('status_payment')
                    ->label('وضعیت پرداختی')
                    ->badge()
                    ->formatStateUsing(fn($state) => PaymentStatuses::from($state)),

                TextColumn::make('payment_method')
                    ->label('درگاه پرداخت')
                    ->badge()
                    ->formatStateUsing(fn($state) => PaymentMethod::from($state)),

                TextColumn::make('created_at')
                    ->label('ایجاد شده در')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('به روز شده در')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

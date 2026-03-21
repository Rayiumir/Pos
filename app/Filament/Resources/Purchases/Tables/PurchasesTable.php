<?php

namespace App\Filament\Resources\Purchases\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PurchasesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('purchase_number')
                    ->label('شماره خرید')
                    ->searchable(),

                TextColumn::make('user_id')
                    ->label('کاربر')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('supplier_id')
                    ->label('تامین کننده')
                    ->numeric()
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
                    ->numeric()
                    ->sortable(),

                TextColumn::make('tax_rate')
                    ->label('درصد مالیات')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('tax_amount')
                    ->label('مبلغ مالیات')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('discount')
                    ->label('درصد تخفیف')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('discount_amount')
                    ->label('مبلغ تخفیف')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('total_payment')
                    ->label('کل پرداختی')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('وضعیت')
                    ->badge(),

                TextColumn::make('status_payment')
                    ->label('وضعیت پرداختی')
                    ->badge(),

                TextColumn::make('payment_method')
                    ->label('درصد مالیات')
                    ->badge(),

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
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

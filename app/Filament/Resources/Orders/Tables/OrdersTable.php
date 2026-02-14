<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.name')
                    ->numeric()
                    ->label(' مشتری')
                    ->sortable(),
                TextColumn::make('total_price')
                    ->money()
                    ->label('قیمت کل')
                    ->sortable(),
                TextColumn::make('discount')
                    ->label('تخفیف')
                    ->sortable(),
                TextColumn::make('discount_amount')
                    ->label('مبلغ تخفیف')
                    ->sortable(),
                TextColumn::make('total_payment')
                    ->label('کل پرداختی')
                    ->sortable(),
                BadgeColumn::make('status')
                    ->label('وضعیت')
                    ->colors([
                        'gray' => 'new',
                        'success' => 'completed',
                        'danger' => 'canceled',
                        'warning' => 'processing',
                    ])
                    ->formatStateUsing(fn ($state) => match($state) {
                        'new' => 'جدید',
                        'processing' => 'در حال پردازش',
                        'canceled' => 'لغو شده',
                        'completed' => 'تکمیل شده',
                        default => $state,
                    })
                    ->sortable(),
                TextColumn::make('date')
                    ->date()
                    ->label('تاریخ سفارش')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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

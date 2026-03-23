<?php

namespace App\Filament\Resources\Widgets;

use App\Models\Order;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LastOrders extends TableWidget
{
    use HasWidgetShield;

    protected static ?string $heading = 'لیست مشتریان';

    public function table(Table $table): Table
    {
        return $table
            ->query(Order::query()->latest()->take(5))
            ->columns([
                TextColumn::make('id')
                    ->label(' شناسه'),

                TextColumn::make('customer.name')
                    ->numeric()
                    ->label(' مشتری')
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
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}

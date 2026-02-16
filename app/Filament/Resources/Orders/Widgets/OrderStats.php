<?php

namespace App\Filament\Resources\Orders\Widgets;

use App\Models\Order;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('جدید', Order::where('status', 'new')->count())
                ->description('سفارشات جدید ثبت شده است')
                ->descriptionIcon('heroicon-m-clock')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('info'),

            Stat::make('پردازش شده', Order::where('status', 'processing')->count())
                ->description('سفارشاتی که در حال حاضر در پردازش هستند')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('warning'),

            Stat::make('تکمیل شده', Order::where('status', 'completed')->count())
                ->description('سفارش با موفقیت انجام شد')
                ->descriptionIcon('heroicon-m-check-badge')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),

            Stat::make('کل درآمد','$ ' .number_format(Order::where('status', 'completed')->sum('total_payment'), 0))
                ->description('درآمد کسب شده است')
                ->descriptionIcon('heroicon-m-banknotes')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('danger'),
        ];
    }
}

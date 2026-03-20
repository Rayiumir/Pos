<?php

namespace App\Filament\Resources\Widgets;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Faker\Provider\Base;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\Widget;

class StatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make('کل محصولات', Product::count())
                ->description('تعداد محصولاتی که وارد شده است')
                ->descriptionIcon('heroicon-s-squares-2x2', IconPosition::Before)
                ->chart([1,5,12,8,20])
                ->color('primary'),

            Stat::make('کل مشتریان', Customer::count())
                ->description('تعداد مشتریانی که در سیستم ثبت نام شده است')
                ->descriptionIcon('heroicon-s-user-group', IconPosition::Before)
                ->chart([1,5,12,8,20])
                ->color('primary'),

            Stat::make('کل سفارشات', Order::count())
                ->description('تعداد سفارشاتی که ایجاد شده است')
                ->descriptionIcon('heroicon-s-shopping-cart', IconPosition::Before)
                ->chart([1,5,12,8,20])
                ->color('primary'),

            Stat::make('کل درآمد','$ ' .number_format(Order::where('status', 'completed')->sum('total_payment'), 0))
                ->description('کل درآمد ثبت شده')
                ->descriptionIcon('heroicon-m-banknotes', IconPosition::Before)
                ->chart([7,2,10,3,15,4,17])
                ->color('danger'),

        ];
    }
}

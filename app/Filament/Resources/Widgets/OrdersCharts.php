<?php

namespace App\Filament\Resources\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class OrdersCharts extends ChartWidget
{
    protected ?string $heading = 'آمار سفارشات';

    protected function getData(): array
    {
        $data = Trend::model(Order::class) -> between(
            start: now()->subMonth(6),
            end: now(),
        )
        ->perMonth()
        ->count();

        return [
            'datasets' => [
                [
                    'label' => 'آمار سفارشات',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => date('M Y', strtotime($value->date)))
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

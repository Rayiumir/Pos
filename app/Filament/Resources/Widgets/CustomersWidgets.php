<?php

namespace App\Filament\Resources\Widgets;

use App\Models\Customer;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class CustomersWidgets extends ChartWidget
{
    use HasWidgetShield;

    protected ?string $heading = 'آمار مشتریان';

    protected function getData(): array
    {
        $data = Trend::model(Customer::class) -> between(
            start: now()->subMonth(6),
            end: now(),
        )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'آمار مشتریان',
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

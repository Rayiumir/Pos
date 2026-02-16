<?php

namespace App\Filament\Exports;

use App\Models\Order;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class OrderExporter extends Exporter
{
    protected static ?string $model = Order::class;
    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('شناسه'),
            ExportColumn::make('customer.name')
                ->label('نام مشتری'),
            ExportColumn::make('total_price')
                ->label('قیمت کل'),
            ExportColumn::make('discount')
                ->label('تخفیف'),
            ExportColumn::make('discount_amount')
                ->label('درصد تخفیف'),
            ExportColumn::make('status')
                ->label('وضعیت'),
            ExportColumn::make('total_payment')
                ->label('کل پرداختی'),
            ExportColumn::make('payment_status')
                ->label('وضعیت پرداختی'),
            ExportColumn::make('payment_method')
                ->label('درگاه پرداختی'),
            ExportColumn::make('date')
                ->label('تاریخ'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your order export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}

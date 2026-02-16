<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use App\Filament\Resources\Orders\Widgets\OrderStats;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;
    protected static ?string $title = 'مدیریت سفارشات';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(' سفارش جدید')
                ->icon('heroicon-o-plus'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStats::class
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('همه'),
            'جدید' => Tab::make()->query(fn($query) => $query->where('status', 'new')),
            'پردازش شده' => Tab::make()->query(fn($query) => $query->where('status', 'processing')),
            'تکمیل شده' => Tab::make()->query(fn($query) => $query->where('status', 'completed')),
            'لغو شده' => Tab::make()->query(fn($query) => $query->where('status', 'canceled'))
        ];
    }
}

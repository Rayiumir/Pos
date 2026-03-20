<?php

namespace App\Filament\Resources\Widgets;

use App\Models\OrderDetail;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Support\Facades\DB;

class BestSelling extends TableWidget
{
    protected static ?string $heading = 'بهترین فروش محصولات';

    public function table(Table $table): Table
    {
        return $table
            ->query(OrderDetail::query()
                ->select('product_id as id', 'product_id', DB::raw('SUM(qty) as total_sold'))
                ->with('product')
                ->groupBy('product_id')
                ->orderByDesc('total_sold')
                ->take(5)
            )
            ->columns([
                ImageColumn::make('product.image')
                    ->label('عکس محصول')
                    ->getStateUsing(fn($record) => $record -> product -> image ?? 'موجود نیست'),

                TextColumn::make('product.name')
                    ->label('نام محصول')
                    ->getStateUsing(fn($record) => $record -> product -> title ?? 'موجود نیست'),

                TextColumn::make('total_sold')
                    ->label('کل فروش')
            ])->paginated(false)
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

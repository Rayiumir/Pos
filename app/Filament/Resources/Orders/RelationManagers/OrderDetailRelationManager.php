<?php

namespace App\Filament\Resources\Orders\RelationManagers;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\Product;

class OrderDetailRelationManager extends RelationManager
{
    protected static string $relationship = 'orderdetails';

    protected static ?string $relatedResource = OrderResource::class;
    protected static ?string $title = 'جزئیات سفارشات';

    public function table(Table $table): Table
    {

        return $table
            ->columns([
                ImageColumn::make('product.image'),
                TextColumn::make('product.title')
                    ->label('نام محصول')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('product.price')
                    ->label('قیمت واحد')
                    ->sortable(),

                TextColumn::make('qty')
                    ->label('تعداد')
                    ->numeric()
                    ->alignCenter(),

                TextColumn::make('subtotal')
                    ->label('جمع جزء')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->dateTime('Y/m/d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('حذف انتخاب شده‌ها'),
                ]),
            ]);
    }
}

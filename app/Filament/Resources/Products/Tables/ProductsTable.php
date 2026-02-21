<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('عکس محصول'),
                TextColumn::make('title')
                    ->label('عنوان محصول')
                    ->searchable(),
                TextColumn::make('price')
                    ->label('قیمت محصول')
                    ->money()
                    ->sortable(),
                TextColumn::make('stock')
                    ->label('موجودی انبار')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('ایجاد شده در')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('به روز رسانی در')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('brand.title')
                    ->label('انتخاب برند')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('category.title')
                    ->label('انتخاب دسته بندی')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('subCategory.title')
                    ->label('انتخاب زیر دسته بندی')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('فعال')
                    ->boolean(),
                IconColumn::make('in_stock')
                    ->label('موجودی فعال')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

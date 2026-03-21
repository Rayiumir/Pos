<?php

namespace App\Filament\Resources\Uoms\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UomsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('نام واحد')
                    ->searchable(),

                TextColumn::make('code')
                    ->label('کد واحد')
                    ->searchable(),

                TextColumn::make('baseUnits.name')
                    ->label('واحد پایه')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('symbol')
                    ->label('نماد واحد')
                    ->searchable(),

                IconColumn::make('is_active')
                    ->label('فعال سازی')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('ایجاد شده در')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('به روز شده در')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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

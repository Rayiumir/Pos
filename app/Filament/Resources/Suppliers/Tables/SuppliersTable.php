<?php

namespace App\Filament\Resources\Suppliers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SuppliersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('نام و نام خانوادگی')
                    ->searchable(),

                TextColumn::make('phone')
                    ->label('شماره تلفن')
                    ->searchable(),

                TextColumn::make('address')
                    ->label('آدرس')
                    ->searchable(),

                TextColumn::make('cp_name')
                    ->label('شرکت تامین کننده')
                    ->searchable(),

                TextColumn::make('cp_phone')
                    ->label('شماره تلفن شرکت')
                    ->searchable(),

                TextColumn::make('cp_email')
                    ->label('ایمیل شرکت')
                    ->searchable(),

                IconColumn::make('is_active')
                    ->label('فعال سازی')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('ایجاد در')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('به روز رسانی در')
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

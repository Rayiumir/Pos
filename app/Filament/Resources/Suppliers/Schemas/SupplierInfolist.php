<?php

namespace App\Filament\Resources\Suppliers\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SupplierInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('نام و نام خانوادگی'),

                TextEntry::make('phone')
                    ->label('شماره تلفن'),

                TextEntry::make('address')
                    ->label('آدرس'),

                TextEntry::make('cp_name')
                    ->label('نام شرکت'),

                TextEntry::make('cp_phone')
                    ->label('شماره تماس شرکت'),

                TextEntry::make('cp_email')
                    ->label('ایمیل شرکت'),

                IconEntry::make('is_active')
                    ->label('فعال سازی')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

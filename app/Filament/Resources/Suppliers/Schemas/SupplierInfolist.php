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
                TextEntry::make('name'),
                TextEntry::make('sku_code')
                    ->placeholder('-'),
                TextEntry::make('company_name')
                    ->placeholder('-'),
                TextEntry::make('tax_id')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('Email address')
                    ->placeholder('-'),
                TextEntry::make('phone')
                    ->placeholder('-'),
                TextEntry::make('whatsapp')
                    ->placeholder('-'),
                TextEntry::make('address')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('city')
                    ->placeholder('-'),
                TextEntry::make('province')
                    ->placeholder('-'),
                TextEntry::make('country'),
                TextEntry::make('payment_terms')
                    ->badge(),
                TextEntry::make('payment_terms_notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('credit_limit')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('bank_name')
                    ->placeholder('-'),
                TextEntry::make('bank_account')
                    ->placeholder('-'),
                TextEntry::make('iban')
                    ->placeholder('-'),
                IconEntry::make('is_active')
                    ->boolean(),
                IconEntry::make('is_consignment')
                    ->boolean(),
                TextEntry::make('commission_percentage')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('rating')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Suppliers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SupplierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('sku_code')
                    ->default(null),
                TextInput::make('company_name')
                    ->default(null),
                TextInput::make('tax_id')
                    ->default(null),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->default(null),
                TextInput::make('phone')
                    ->tel()
                    ->default(null),
                TextInput::make('whatsapp')
                    ->default(null),
                Textarea::make('address')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('city')
                    ->default(null),
                TextInput::make('province')
                    ->default(null),
                TextInput::make('country')
                    ->required()
                    ->default('Angola'),
                Select::make('payment_terms')
                    ->options([
            'cash' => 'Cash',
            '7_days' => '7 days',
            '15_days' => '15 days',
            '30_days' => '30 days',
            '60_days' => '60 days',
            'custom' => 'Custom',
        ])
                    ->default('cash')
                    ->required(),
                Textarea::make('payment_terms_notes')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('credit_limit')
                    ->numeric()
                    ->default(null),
                TextInput::make('bank_name')
                    ->default(null),
                TextInput::make('bank_account')
                    ->default(null),
                TextInput::make('iban')
                    ->default(null),
                Toggle::make('is_active')
                    ->required(),
                Toggle::make('is_consignment')
                    ->required(),
                TextInput::make('commission_percentage')
                    ->numeric()
                    ->default(null),
                TextInput::make('rating')
                    ->numeric()
                    ->default(null),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}

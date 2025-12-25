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
                    ->searchable(),
                TextColumn::make('sku_code')
                    ->searchable(),
                TextColumn::make('company_name')
                    ->searchable(),
                TextColumn::make('tax_id')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('whatsapp')
                    ->searchable(),
                TextColumn::make('city')
                    ->searchable(),
                TextColumn::make('province')
                    ->searchable(),
                TextColumn::make('country')
                    ->searchable(),
                TextColumn::make('payment_terms')
                    ->badge(),
                TextColumn::make('credit_limit')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('bank_name')
                    ->searchable(),
                TextColumn::make('bank_account')
                    ->searchable(),
                TextColumn::make('iban')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->boolean(),
                IconColumn::make('is_consignment')
                    ->boolean(),
                TextColumn::make('commission_percentage')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('rating')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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

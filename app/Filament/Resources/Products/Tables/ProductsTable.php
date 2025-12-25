<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('short_description')
                    ->searchable(),
                TextColumn::make('subcategory.name')
                    ->searchable(),
                TextColumn::make('brand.name')
                    ->searchable(),
                TextColumn::make('collection.name')
                    ->searchable(),
                TextColumn::make('price_cost')
                    ->money()
                    ->sortable(),
                TextColumn::make('price_sell')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('discount_percentage')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('weight')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('condition')
                    ->badge(),
                IconColumn::make('is_active')
                    ->boolean(),
                IconColumn::make('is_featured')
                    ->boolean(),
                IconColumn::make('is_new')
                    ->boolean(),
                IconColumn::make('is_trending')
                    ->boolean(),
                IconColumn::make('is_bestseller')
                    ->boolean(),
                IconColumn::make('is_on_sale')
                    ->boolean(),
                TextColumn::make('publish_start')
                    ->date()
                    ->sortable(),
                TextColumn::make('publish_end')
                    ->date()
                    ->sortable(),
                TextColumn::make('meta_title')
                    ->searchable(),
                TextColumn::make('views_count')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sales_count')
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
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}

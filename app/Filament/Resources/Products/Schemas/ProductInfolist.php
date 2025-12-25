<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Product;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('sku')
                    ->label('SKU'),
                TextEntry::make('name'),
                TextEntry::make('slug'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('short_description')
                    ->placeholder('-'),
                TextEntry::make('subcategory.name')
                    ->label('Subcategory'),
                TextEntry::make('brand.name')
                    ->label('Brand')
                    ->placeholder('-'),
                TextEntry::make('collection.name')
                    ->label('Collection')
                    ->placeholder('-'),
                TextEntry::make('price_cost')
                    ->money()
                    ->placeholder('-'),
                TextEntry::make('price_sell')
                    ->numeric(),
                TextEntry::make('discount_percentage')
                    ->numeric(),
                TextEntry::make('weight')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('condition')
                    ->badge(),
                IconEntry::make('is_active')
                    ->boolean(),
                IconEntry::make('is_featured')
                    ->boolean(),
                IconEntry::make('is_new')
                    ->boolean(),
                IconEntry::make('is_trending')
                    ->boolean(),
                IconEntry::make('is_bestseller')
                    ->boolean(),
                IconEntry::make('is_on_sale')
                    ->boolean(),
                TextEntry::make('publish_start')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('publish_end')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('meta_title')
                    ->placeholder('-'),
                TextEntry::make('meta_description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('views_count')
                    ->numeric(),
                TextEntry::make('sales_count')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Product $record): bool => $record->trashed()),
            ]);
    }
}

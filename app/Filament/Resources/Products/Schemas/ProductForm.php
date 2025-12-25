<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('sku')
                    ->label('SKU')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('short_description')
                    ->default(null),
                Select::make('subcategory_id')
                    ->relationship('subcategory', 'name')
                    ->required(),
                Select::make('brand_id')
                    ->relationship('brand', 'name')
                    ->default(null),
                Select::make('collection_id')
                    ->relationship('collection', 'name')
                    ->default(null),
                TextInput::make('price_cost')
                    ->numeric()
                    ->default(null)
                    ->prefix('$'),
                TextInput::make('price_sell')
                    ->required()
                    ->numeric(),
                TextInput::make('discount_percentage')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('weight')
                    ->numeric()
                    ->default(null),
                Select::make('condition')
                    ->options(['new' => 'New', 'used' => 'Used', 'semi_new' => 'Semi new'])
                    ->default('new')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
                Toggle::make('is_featured')
                    ->required(),
                Toggle::make('is_new')
                    ->required(),
                Toggle::make('is_trending')
                    ->required(),
                Toggle::make('is_bestseller')
                    ->required(),
                Toggle::make('is_on_sale')
                    ->required(),
                DatePicker::make('publish_start'),
                DatePicker::make('publish_end'),
                TextInput::make('meta_title')
                    ->default(null),
                Textarea::make('meta_description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('views_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('sales_count')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}

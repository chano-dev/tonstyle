<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\DatePicker;
//use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // IDENTIFICAÇÃO
                TextInput::make('name')
                    ->label('Nome do Produto')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => 
                        $set('slug', Str::slug($state))
                    ),
                TextInput::make('slug')
                    ->label('Slug (URL)')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('sku')
                    ->label('SKU')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->placeholder('DRESS-CKEU-0001'),
                
                // DESCRIÇÃO
                TextInput::make('short_description')
                    ->label('Descrição Curta')
                    ->default(null),
                Textarea::make('description')
                    ->label('Descrição Completa')
                    ->default(null)
                    ->columnSpanFull(),
                
                // CLASSIFICAÇÃO
                Select::make('subcategory_id')
                    ->label('Subcategoria')
                    ->relationship('subcategory', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('brand_id')
                    ->label('Marca')
                    ->relationship('brand', 'name')
                    ->searchable()
                    ->preload()
                    ->default(null),
                Select::make('collection_id')
                    ->label('Coleção')
                    ->relationship('collection', 'name')
                    ->searchable()
                    ->preload()
                    ->default(null),
                
                // PREÇOS
                TextInput::make('price_cost')
                    ->label('Preço de Custo')
                    ->numeric()
                    ->prefix('Kz')
                    ->default(null),
                TextInput::make('price_sell')
                    ->label('Preço de Venda')
                    ->required()
                    ->numeric()
                    ->prefix('Kz'),
                TextInput::make('discount_percentage')
                    ->label('Desconto (%)')
                    ->required()
                    ->numeric()
                    ->suffix('%')
                    ->default(0.0)
                    ->minValue(0)
                    ->maxValue(100),
                TextInput::make('weight')
                    ->label('Peso (gramas)')
                    ->numeric()
                    ->suffix('g')
                    ->default(null),
                
                // CONDIÇÃO
                Select::make('condition')
                    ->label('Condição')
                    ->options([
                        'new' => 'Novo',
                        'used' => 'Usado',
                        'semi_new' => 'Semi-novo'
                    ])
                    ->default('new')
                    ->required(),
                
                // IMAGENS
                /*FileUpload::make('product_images')
                    ->label('Imagens do Produto')
                    ->multiple()
                    ->image()
                    ->directory('products')
                    ->visibility('public')
                    ->maxFiles(10)
                    ->reorderable()
                    ->columnSpanFull(), */
                
                // VISIBILIDADE
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true),
                Toggle::make('is_featured')
                    ->label('Destaque')
                    ->default(false),
                Toggle::make('is_new')
                    ->label('Novidade')
                    ->default(true),
                Toggle::make('is_trending')
                    ->label('Tendência')
                    ->default(false),
                Toggle::make('is_bestseller')
                    ->label('Mais Vendido')
                    ->default(false),
                Toggle::make('is_on_sale')
                    ->label('Em Promoção')
                    ->default(false),
                
                // AGENDAMENTO
                DatePicker::make('publish_start')
                    ->label('Publicar a partir de'),
                DatePicker::make('publish_end')
                    ->label('Publicar até'),
                
                // SEO
                TextInput::make('meta_title')
                    ->label('Título SEO')
                    ->default(null),
                Textarea::make('meta_description')
                    ->label('Descrição SEO')
                    ->default(null)
                    ->columnSpanFull(),
                
                // ESTATÍSTICAS (ocultos)
                TextInput::make('views_count')
                    ->hidden()
                    ->default(0),
                TextInput::make('sales_count')
                    ->hidden()
                    ->default(0),
            ]);
    }
}
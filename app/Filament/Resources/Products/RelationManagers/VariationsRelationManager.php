<?php

namespace App\Filament\Resources\Products\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VariationsRelationManager extends RelationManager
{
    protected static string $relationship = 'variations';

    protected static ?string $title = 'Variações (Stock)';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('color_id')
                    ->label('Cor')
                    ->relationship('color', 'name')
                    ->searchable()
                    ->preload()
                    ->placeholder('Selecione a cor'),
                Select::make('size_id')
                    ->label('Tamanho')
                    ->relationship('size', 'name')
                    ->searchable()
                    ->preload()
                    ->placeholder('Selecione o tamanho'),
                TextInput::make('sku_variation')
                    ->label('SKU da Variação')
                    ->required()
                    ->placeholder('DRESS-CKEU-0001-RED-M')
                    ->helperText('Código único para esta combinação cor+tamanho'),
                TextInput::make('price_adjustment')
                    ->label('Ajuste de Preço')
                    ->numeric()
                    ->default(0)
                    ->prefix('Kz')
                    ->helperText('Ex: +500 para tamanhos grandes, -200 para promoção'),
                TextInput::make('stock_quantity')
                    ->label('Stock Total')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->helperText('Quantidade em armazém'),
                TextInput::make('stock_reserved')
                    ->label('Stock Reservado')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->helperText('Em carrinhos de clientes'),
                TextInput::make('stock_min')
                    ->label('Stock Mínimo')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->helperText('Alerta quando chegar a este valor'),
                FileUpload::make('image_path')
                    ->label('Imagem da Variação')
                    ->image()
                    ->directory('products/variations')
                    ->disk('public')
                    ->visibility('public')
                    ->helperText('Opcional: imagem específica para esta cor'),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true)
                    ->helperText('Variação disponível para venda'),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('color.name')
                    ->label('Cor')
                    ->placeholder('Sem cor'),
                TextEntry::make('size.name')
                    ->label('Tamanho')
                    ->placeholder('Sem tamanho'),
                TextEntry::make('sku_variation')
                    ->label('SKU'),
                TextEntry::make('price_adjustment')
                    ->label('Ajuste de Preço')
                    ->money('AOA'),
                TextEntry::make('stock_quantity')
                    ->label('Stock Total'),
                TextEntry::make('stock_reserved')
                    ->label('Reservado'),
                TextEntry::make('stock_min')
                    ->label('Stock Mínimo'),
                ImageEntry::make('image_path')
                    ->label('Imagem')
                    ->placeholder('Usa imagem do produto'),
                IconEntry::make('is_active')
                    ->label('Activo')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('sku_variation')
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Img')
                    ->circular()
                    ->size(40)
                    ->defaultImageUrl(fn ($record) => $record->product?->primaryImageUrl),
                TextColumn::make('color.name')
                    ->label('Cor')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('size.name')
                    ->label('Tamanho')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('sku_variation')
                    ->label('SKU')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('price_adjustment')
                    ->label('Ajuste')
                    ->money('AOA')
                    ->sortable()
                    ->color(fn ($state) => $state > 0 ? 'success' : ($state < 0 ? 'danger' : 'gray')),
                TextColumn::make('stock_quantity')
                    ->label('Stock')
                    ->numeric()
                    ->sortable()
                    ->color(fn ($record) => 
                        $record->stock_quantity <= $record->stock_min ? 'danger' : 
                        ($record->stock_quantity <= $record->stock_min * 2 ? 'warning' : 'success')
                    ),
                TextColumn::make('stock_reserved')
                    ->label('Reserv.')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('stock_available')
                    ->label('Disponível')
                    ->state(fn ($record) => $record->stock_quantity - $record->stock_reserved)
                    ->numeric()
                    ->color(fn ($state) => $state > 0 ? 'success' : 'danger'),
                IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),
            ])
            ->defaultSort('color.name')
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Adicionar Variação'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
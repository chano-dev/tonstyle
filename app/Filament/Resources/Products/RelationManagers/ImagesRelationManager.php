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

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    protected static ?string $title = 'Imagens do Produto';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('file_path')
                    ->label('Imagem')
                    ->image()
                    ->directory('products')
                    ->visibility('public')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('file_name')
                    ->label('Nome do Ficheiro')
                    ->required()
                    ->maxLength(255),
                Select::make('image_type')
                    ->label('Tipo de Imagem')
                    ->options([
                        'main' => 'Principal',
                        'front' => 'Frente',
                        'back' => 'Costas',
                        'side' => 'Lateral',
                        'detail' => 'Detalhe',
                        'model' => 'Com Modelo',
                        'flat' => 'Flat Lay',
                        'lifestyle' => 'Lifestyle',
                    ])
                    ->default('main')
                    ->required(),
                Toggle::make('is_primary')
                    ->label('Imagem Principal?')
                    ->default(false)
                    ->helperText('Apenas uma imagem deve ser principal'),
                TextInput::make('display_order')
                    ->label('Ordem')
                    ->numeric()
                    ->default(0)
                    ->helperText('0 = primeira posição'),
                TextInput::make('alt_text')
                    ->label('Texto Alternativo (SEO)')
                    ->placeholder('Descrição da imagem para SEO')
                    ->maxLength(255),
                Select::make('variation_id')
                    ->label('Variação (opcional)')
                    ->relationship('variation', 'sku_variation')
                    ->placeholder('Todas as variações')
                    ->helperText('Deixe vazio para imagem geral'),
                TextInput::make('file_size')
                    ->hidden(),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('file_path')
                    ->label('Imagem'),
                TextEntry::make('file_name')
                    ->label('Nome'),
                TextEntry::make('image_type')
                    ->label('Tipo')
                    ->badge(),
                IconEntry::make('is_primary')
                    ->label('Principal')
                    ->boolean(),
                TextEntry::make('display_order')
                    ->label('Ordem'),
                TextEntry::make('alt_text')
                    ->label('Texto Alt')
                    ->placeholder('-'),
                TextEntry::make('variation.sku_variation')
                    ->label('Variação')
                    ->placeholder('Geral'),
                TextEntry::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('file_name')
            ->columns([
                ImageColumn::make('file_path')
                    ->label('Imagem')
                    ->square()
                    ->size(60),
                TextColumn::make('file_name')
                    ->label('Nome')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('image_type')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'main' => 'Principal',
                        'front' => 'Frente',
                        'back' => 'Costas',
                        'side' => 'Lateral',
                        'detail' => 'Detalhe',
                        'model' => 'Modelo',
                        'flat' => 'Flat Lay',
                        'lifestyle' => 'Lifestyle',
                        default => $state,
                    }),
                IconColumn::make('is_primary')
                    ->label('Principal')
                    ->boolean(),
                TextColumn::make('display_order')
                    ->label('Ordem')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Criado')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('display_order')
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Adicionar Imagem'),
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
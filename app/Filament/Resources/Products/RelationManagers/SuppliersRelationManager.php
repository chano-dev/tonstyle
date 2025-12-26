<?php

namespace App\Filament\Resources\Products\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SuppliersRelationManager extends RelationManager
{
    protected static string $relationship = 'suppliers';

    protected static ?string $title = 'Fornecedores';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('cost_price')
                    ->label('Preço de Custo')
                    ->numeric()
                    ->prefix('Kz')
                    ->required()
                    ->helperText('Quanto pagas a este fornecedor'),
                TextInput::make('commission_percentage')
                    ->label('Comissão (%)')
                    ->numeric()
                    ->suffix('%')
                    ->default(0)
                    ->minValue(0)
                    ->maxValue(100)
                    ->helperText('Para produtos em consignação'),
                Toggle::make('is_preferred')
                    ->label('Fornecedor Preferido')
                    ->default(false)
                    ->helperText('Fornecedor principal para este produto'),
                TextInput::make('lead_time_days')
                    ->label('Prazo de Entrega')
                    ->numeric()
                    ->suffix('dias')
                    ->default(0)
                    ->helperText('Tempo médio de entrega'),
                TextInput::make('min_order_quantity')
                    ->label('Quantidade Mínima')
                    ->numeric()
                    ->default(1)
                    ->helperText('Encomenda mínima'),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true)
                    ->helperText('Fornecedor activo para este produto'),
                Textarea::make('notes')
                    ->label('Notas')
                    ->placeholder('Observações sobre este fornecedor para este produto')
                    ->columnSpanFull(),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Fornecedor'),
                TextEntry::make('company_name')
                    ->label('Empresa')
                    ->placeholder('-'),
                TextEntry::make('pivot.cost_price')
                    ->label('Preço de Custo')
                    ->money('AOA'),
                TextEntry::make('pivot.commission_percentage')
                    ->label('Comissão')
                    ->suffix('%')
                    ->placeholder('0%'),
                IconEntry::make('pivot.is_preferred')
                    ->label('Preferido')
                    ->boolean(),
                TextEntry::make('pivot.lead_time_days')
                    ->label('Prazo de Entrega')
                    ->suffix(' dias')
                    ->placeholder('-'),
                TextEntry::make('pivot.min_order_quantity')
                    ->label('Qtd. Mínima')
                    ->placeholder('1'),
                IconEntry::make('pivot.is_active')
                    ->label('Activo')
                    ->boolean(),
                TextEntry::make('phone')
                    ->label('Telefone')
                    ->placeholder('-'),
                TextEntry::make('whatsapp')
                    ->label('WhatsApp')
                    ->placeholder('-'),
                TextEntry::make('pivot.notes')
                    ->label('Notas')
                    ->placeholder('-')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Fornecedor')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('company_name')
                    ->label('Empresa')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('pivot.cost_price')
                    ->label('Preço Custo')
                    ->money('AOA')
                    ->sortable(),
                TextColumn::make('pivot.commission_percentage')
                    ->label('Comissão')
                    ->suffix('%')
                    ->sortable()
                    ->color(fn ($state) => $state > 0 ? 'warning' : 'gray'),
                IconColumn::make('pivot.is_preferred')
                    ->label('Preferido')
                    ->boolean(),
                TextColumn::make('pivot.lead_time_days')
                    ->label('Prazo')
                    ->suffix(' dias')
                    ->sortable(),
                IconColumn::make('is_consignment')
                    ->label('Consign.')
                    ->boolean(),
                IconColumn::make('pivot.is_active')
                    ->label('Activo')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->label('Associar Fornecedor')
                    ->preloadRecordSelect()
                    ->form(fn (AttachAction $action): array => [
                        $action->getRecordSelect()
                            ->label('Fornecedor')
                            ->placeholder('Selecione um fornecedor'),
                        TextInput::make('cost_price')
                            ->label('Preço de Custo')
                            ->numeric()
                            ->prefix('Kz')
                            ->required(),
                        TextInput::make('commission_percentage')
                            ->label('Comissão (%)')
                            ->numeric()
                            ->suffix('%')
                            ->default(0),
                        Toggle::make('is_preferred')
                            ->label('Fornecedor Preferido')
                            ->default(false),
                        TextInput::make('lead_time_days')
                            ->label('Prazo de Entrega (dias)')
                            ->numeric()
                            ->default(0),
                        TextInput::make('min_order_quantity')
                            ->label('Quantidade Mínima')
                            ->numeric()
                            ->default(1),
                        Toggle::make('is_active')
                            ->label('Activo')
                            ->default(true),
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make()
                    ->form(fn (): array => [
                        TextInput::make('cost_price')
                            ->label('Preço de Custo')
                            ->numeric()
                            ->prefix('Kz')
                            ->required(),
                        TextInput::make('commission_percentage')
                            ->label('Comissão (%)')
                            ->numeric()
                            ->suffix('%')
                            ->default(0),
                        Toggle::make('is_preferred')
                            ->label('Fornecedor Preferido'),
                        TextInput::make('lead_time_days')
                            ->label('Prazo de Entrega (dias)')
                            ->numeric(),
                        TextInput::make('min_order_quantity')
                            ->label('Quantidade Mínima')
                            ->numeric(),
                        Toggle::make('is_active')
                            ->label('Activo'),
                        Textarea::make('notes')
                            ->label('Notas')
                            ->columnSpanFull(),
                    ]),
                DetachAction::make()
                    ->label('Desassociar'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}
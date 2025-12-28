<?php

namespace App\Filament\Resources\Services\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
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

    protected static ?string $title = 'Portfolio / Galeria';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('file_path')
                    ->label('Imagem')
                    ->image()
                    ->directory('services')
                    ->disk('public')
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
                        'portfolio' => 'Portfolio',
                        'before' => 'Antes',
                        'after' => 'Depois',
                        'process' => 'Processo',
                        'result' => 'Resultado',
                    ])
                    ->default('portfolio')
                    ->required(),
                TextInput::make('caption')
                    ->label('Legenda')
                    ->placeholder('Descrição da imagem')
                    ->maxLength(255),
                DatePicker::make('work_date')
                    ->label('Data do Trabalho')
                    ->placeholder('Quando foi realizado'),
                Toggle::make('is_featured')
                    ->label('Destaque')
                    ->default(false)
                    ->helperText('Mostrar em destaque no portfolio'),
                TextInput::make('display_order')
                    ->label('Ordem')
                    ->numeric()
                    ->default(0)
                    ->helperText('0 = primeira posição'),
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
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'main' => 'Principal',
                        'portfolio' => 'Portfolio',
                        'before' => 'Antes',
                        'after' => 'Depois',
                        'process' => 'Processo',
                        'result' => 'Resultado',
                        default => $state,
                    }),
                TextEntry::make('caption')
                    ->label('Legenda')
                    ->placeholder('-'),
                TextEntry::make('work_date')
                    ->label('Data do Trabalho')
                    ->date('d/m/Y')
                    ->placeholder('-'),
                IconEntry::make('is_featured')
                    ->label('Destaque')
                    ->boolean(),
                TextEntry::make('display_order')
                    ->label('Ordem'),
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
                        'portfolio' => 'Portfolio',
                        'before' => 'Antes',
                        'after' => 'Depois',
                        'process' => 'Processo',
                        'result' => 'Resultado',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match($state) {
                        'main' => 'success',
                        'before' => 'warning',
                        'after' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('caption')
                    ->label('Legenda')
                    ->searchable()
                    ->limit(30)
                    ->placeholder('-'),
                TextColumn::make('work_date')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable()
                    ->placeholder('-'),
                IconColumn::make('is_featured')
                    ->label('Destaque')
                    ->boolean(),
                TextColumn::make('display_order')
                    ->label('Ordem')
                    ->sortable(),
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
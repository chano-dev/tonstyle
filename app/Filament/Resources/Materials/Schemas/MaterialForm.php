<?php

namespace App\Filament\Resources\Materials\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MaterialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('material_type')
                    ->options([
            'fabric' => 'Fabric',
            'metal' => 'Metal',
            'plastic' => 'Plastic',
            'leather' => 'Leather',
            'glass' => 'Glass',
            'wood' => 'Wood',
            'ceramic' => 'Ceramic',
            'synthetic' => 'Synthetic',
            'natural' => 'Natural',
            'mixed' => 'Mixed',
        ])
                    ->default('fabric')
                    ->required(),
                Toggle::make('is_natural')
                    ->required(),
                Select::make('care_level')
                    ->options(['easy' => 'Easy', 'moderate' => 'Moderate', 'delicate' => 'Delicate'])
                    ->default('moderate')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('display_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Collections\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CollectionForm
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
                TextInput::make('year')
                    ->required(),
                Select::make('season')
                    ->options([
            'revellion' => 'Revellion',
            'valentine' => 'Valentine',
            'all_year' => 'All year',
            'special' => 'Special',
            'halloween' => 'Halloween',
            'school' => 'School',
            'weeding' => 'Weeding',
            'vacations' => 'Vacations',
            'work' => 'Work',
            'spring_summer' => 'Spring summer',
            'fall_winter' => 'Fall winter',
        ])
                    ->default('all_year')
                    ->required(),
                DatePicker::make('launch_date'),
                DatePicker::make('end_date'),
                FileUpload::make('image_path')
                    ->image(),
                Toggle::make('is_active')
                    ->required(),
                Toggle::make('is_featured')
                    ->required(),
                TextInput::make('display_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('meta_title')
                    ->default(null),
                Textarea::make('meta_description')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BrandInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('slug'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('logo_path')
                    ->placeholder('-'),
                TextEntry::make('banner_path')
                    ->placeholder('-'),
                TextEntry::make('country_origin')
                    ->placeholder('-'),
                IconEntry::make('is_active')
                    ->boolean(),
                IconEntry::make('is_featured')
                    ->boolean(),
                TextEntry::make('display_order')
                    ->numeric(),
                TextEntry::make('meta_title')
                    ->placeholder('-'),
                TextEntry::make('meta_description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

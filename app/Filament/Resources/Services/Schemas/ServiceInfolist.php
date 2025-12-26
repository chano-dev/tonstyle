<?php

namespace App\Filament\Resources\Services\Schemas;

use App\Models\Service;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ServiceInfolist
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
                TextEntry::make('short_description')
                    ->placeholder('-'),
                TextEntry::make('subcategory.name')
                    ->label('Subcategory'),
                TextEntry::make('segment.name')
                    ->label('Segment')
                    ->placeholder('-'),
                TextEntry::make('base_price')
                    ->money(),
                TextEntry::make('price_type')
                    ->badge(),
                IconEntry::make('requires_measurements')
                    ->boolean(),
                IconEntry::make('requires_deposit')
                    ->boolean(),
                TextEntry::make('deposit_percentage')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('duration_minutes')
                    ->numeric()
                    ->placeholder('-'),
                ImageEntry::make('image_path')
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
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Service $record): bool => $record->trashed()),
            ]);
    }
}

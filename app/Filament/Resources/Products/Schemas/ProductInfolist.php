<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Product Tabs')
                ->tabs([
                    Tab::make('Product Detail')
                        ->icon('heroicon-o-academic-cap')
                        ->schema([
                            TextEntry::make('name')
                                ->label('Product Name')
                                ->weight('bold')
                                ->color('primary'),
                            TextEntry::make('sku')
                                ->label('Product SKU')
                                ->badge()
                                ->color('success'),
                            TextEntry::make('description')
                                ->label('Product Description'),
                            TextEntry::make('created_at')
                                ->label('Product Creation Date')
                                ->date('d M Y')
                                ->color('info'),
                        ]),
                    Tab::make('Pricing & Stock')
                        ->icon('heroicon-o-currency-dollar')
                        ->badge('10')
                        ->badgeColor('info')
                        ->schema([
                            TextEntry::make('price')
                                ->label('Product Price')
                                ->weight('bold')
                                ->color('primary')
                                ->icon('heroicon-o-currency-dollar'),
                            TextEntry::make('stock')
                                ->label('Product Stock'),
                        ]),
                    Tab::make('Media & Status')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            ImageEntry::make('image')
                                ->label('Product Image')
                                ->disk('public'),
                            TextEntry::make('price')
                                ->label('Product Price')
                                ->weight('bold')
                                ->color('primary')
                                ->icon('heroicon-o-currency-dollar'),
                            TextEntry::make('stock')
                                ->label('Product Stock')
                                ->weight('bold')
                                ->color('primary'),
                            IconEntry::make('is_active')
                                ->label('Is Active?')
                                ->boolean(),
                            IconEntry::make('is_featured')
                                ->label('Is Featured?')
                                ->boolean(),
                        ]),
                ])->columnSpanFull()->vertical(),
                Section::make('Product Info')
                    ->description('')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Product Name')
                            ->weight('bold')
                            ->color('primary'),
                        TextEntry::make('id')
                            ->label('Product ID'),
                        TextEntry::make('sku')
                            ->label('Product SKU')
                            ->badge()
                            ->color('warning'),
                        TextEntry::make('description')
                            ->label('Product Description'),
                        TextEntry::make('created_at')
                            ->label('Product Creation Date')
                            ->date('d M Y')
                            ->color('info'),
                    ])
                    ->columnSpanFull(),
                Section::make('Pricing & Stock')
                    ->description('')
                    ->schema([
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->icon('heroicon-o-currency-dollar')
                            ->formatStateUsing(fn(string $state): string => 'Rp ' . number_format($state, 0, ',', '.')),
                        TextEntry::make('stock')
                            ->label('Product Stock')
                            ->icon('heroicon-o-cube'),
                    ])
                    ->columnSpanFull(),
                Section::make('Image & Status')
                    ->description('')
                    ->schema([
                        ImageEntry::make('image')
                            ->label('Product Image')
                            ->disk('public'),
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->icon('heroicon-o-currency-dollar')
                            ->formatStateUsing(fn(string $state): string => 'Rp ' . number_format($state, 0, ',', '.')),
                        TextEntry::make('stock')
                            ->label('Product Stock')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-o-cube'),
                        IconEntry::make('is_active')
                            ->label('Is Active')
                            ->boolean(),
                        IconEntry::make('is_featured')
                            ->label('Is Featured')
                            ->boolean(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}

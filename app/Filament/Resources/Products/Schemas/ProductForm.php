<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Product Info')
                        ->description('Isi Informasi Produk')
                        ->icon('heroicon-o-shopping-bag')
                        ->schema([
                            Group::make([
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('sku')
                                    ->label('SKU (Stock Keeping Unit)')
                                    ->required(),
                            ])->columns(2),
                            MarkdownEditor::make('description')
                        ]),

                    Step::make('Pricing & Stock')
                        ->description('Isi harga dan jumlah stok')
                        ->icon('heroicon-o-currency-dollar')
                        ->schema([
                            TextInput::make('price')
                                ->numeric()
                                ->prefix('Rp')
                                ->minValue(1)
                                ->required(),
                            TextInput::make('stock')
                                ->numeric()
                                ->minValue(0)
                                ->required(),
                        ])->columns(2),

                    Step::make('Media & Status')
                        ->description('Upload gambar dan atur status')
                        ->icon('heroicon-o-photo') 
                        ->schema([
                            FileUpload::make('image')
                                ->image()
                                ->disk('public')
                                ->directory('products')
                                ->columnSpanFull(),
                            Group::make([
                                Checkbox::make('is_active')
                                    ->label('Produk Aktif'),
                                Checkbox::make('is_featured')
                                    ->label('Produk Unggulan'),
                            ])->columns(2),
                        ]),
                ])
                    ->columnSpanFull()
                    ->submitAction(
                        Action::make('save')
                            ->label('Save Product')
                            ->color('primary')
                            ->submit('save')
                    ),
            ]);
    }
}

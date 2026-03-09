<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable(),
                TextColumn::make('sku')->sortable(),
                TextColumn::make('price')->sortable(),
                TextColumn::make('stock')->sortable(),
                ImageColumn::make('image')
                    ->disk('public'),
                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->color(fn(bool $state): string => match ($state) {
                        true => 'success',
                        false => 'danger',  
                    })->formatStateUsing(fn(bool $state): string => $state ? 'Active' : 'Inactive'),
            ])->defaultSort('created_at', 'asc')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

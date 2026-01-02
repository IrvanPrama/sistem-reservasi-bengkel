<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductStockResource\Pages;
use App\Models\Product;
use App\Models\ProductStock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductStockResource extends Resource
{
    protected static ?string $model = ProductStock::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Database';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Lihat Stok Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_name')
                  ->options([
                      Product::query()->pluck('product_name', 'product_name')->toArray(),
                  ])
                  ->reactive()
                  ->afterStateUpdated(function ($state, callable $set) {
                      $product = Product::where('product_name', $state)->first();
                      $set('sku', $product?->sku ?? '');
                      $set('sell_price', $product?->sell_price ?? '');
                  }),
                Forms\Components\TextInput::make('sku')
                    ->maxLength(100),
                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('sell_price')
                    ->numeric()
                    ->required(),
                Forms\Components\Textarea::make('notes'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('product_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('sku')->sortable(),
                Tables\Columns\TextColumn::make('quantity')->sortable(),
                Tables\Columns\TextColumn::make('sell_price')->money('idr', true), // jika tersedia; alternatif -> formatStateUsing(...)
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductStocks::route('/'),
            'create' => Pages\CreateProductStock::route('/create'),
            'edit' => Pages\EditProductStock::route('/{record}/edit'),
        ];
    }
}

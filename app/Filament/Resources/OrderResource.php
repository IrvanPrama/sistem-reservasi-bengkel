<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('customer_phone')
                    ->label('No. Telepon')
                    ->required()
                    ->maxLength(20),

                Forms\Components\Repeater::make('items')
                    ->relationship('items')
                    ->label('Produk yang dipesan')
                    ->schema([

                        Forms\Components\Select::make('product_id')
                            ->label('Produk')
                            ->relationship('product', 'product_name')
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                if ($state) {
                                    $product = \App\Models\Product::find($state);

                                    // isi harga produk
                                    $set('price', $product?->price ?? 0);

                                    // hitung total ulang
                                    $items = $get('../../items');
                                    $total = collect($items)->sum(function ($item) {
                                        $product = \App\Models\Product::find($item['product_id'] ?? null);
                                        $qty = (int)($item['quantity'] ?? 0);
                                        $price = (float)($product?->price ?? 0);
                                        return $qty * $price;
                                    });
                                    $set('../../total_amount', $total);
                                }
                            })
                            ->formatStateUsing(fn ($state) => $state !== null 
                                ? number_format($state, 0, ',', '.') 
                                : 0
                            ),

                        Forms\Components\TextInput::make('quantity')
                            ->label('Jumlah')
                            ->numeric()
                            ->minValue(1)
                            ->default(1)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $items = $get('../../items'); 
                                $total = collect($items)->sum(function ($item) {
                                    $product = \App\Models\Product::find($item['product_id'] ?? null);
                                    $qty = (int)($item['quantity'] ?? 0);
                                    $price = (float)($product?->price ?? 0);
                                    return $qty * $price;
                                });
                                $set('../../total_amount', $total);
                            }),

                        Forms\Components\TextInput::make('price')
                            ->label('Harga Satuan')
                            ->numeric()
                            ->readOnly(),
                    ])
                    ->columns(3)
                    ->createItemButtonLabel('Tambah Produk'),

                Forms\Components\TextInput::make('total_amount')
                    ->label('Total Bayar')
                    ->numeric()
                    ->readOnly()
                    ->prefix('Rp')
                    ->formatStateUsing(fn ($state) => $state !== null 
                        ? number_format($state, 0, ',', '.') 
                        : 0
                    ), 
            ]);
    }

    public static function table(Table $table): Table
    {
       return $table
        ->columns([
            Tables\Columns\TextColumn::make('id')
                ->label('Order ID')
                ->sortable(),

            Tables\Columns\TextColumn::make('items_count')
                ->counts('items')
                ->label('Jumlah Produk'),

            Tables\Columns\TextColumn::make('customer_name')
                ->label('Nama Pelanggan'),

            Tables\Columns\TextColumn::make('customer_phone')
                ->label('No. Telepon'),
                
            Tables\Columns\TextColumn::make('total_amount')
                ->label('Total Bayar')
                ->sortable()
                ->prefix('Rp')
                ->formatStateUsing(fn ($state) => $state !== null 
                    ? number_format($state, 0, ',', '.') 
                    : 0
                ),

            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),

            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
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
            RelationManagers\ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}

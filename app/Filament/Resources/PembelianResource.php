<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembelianResource\Pages;
use App\Models\Pembelian;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PembelianResource extends Resource
{
    protected static ?string $model = Pembelian::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Tambah Stok/Pembelian Produk';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 14;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('product_id')
                    ->label('Pilih Produk')
                    ->options(Product::query()->pluck('product_name', 'id'))
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        // Ambil product berdasarkan id yang dipilih
                        $product = Product::find($state);
                        // Isi otomatis field SKU
                        $set('product_name', $product?->product_name ?? '');
                        $set('sku', $product?->sku ?? '');
                        $set('sell_price', $product?->sell_price ?? '');
                    }),

                TextInput::make('product_name')
                    ->label('Produkt Name')
                    ->required()
                    ->maxLength(255)
                    ->disabled() // Supaya tidak bisa diubah manual
                    ->dehydrated(), // Tapi tetap disimpan di database

                TextInput::make('sku')
                    ->label('SKU')
                    ->required()
                    ->maxLength(255)
                    ->disabled() // Supaya tidak bisa diubah manual
                    ->dehydrated(), // Tapi tetap disimpan di database

                TextInput::make('nama_supplier')
                    ->required()
                    ->maxLength(255),
                TextInput::make('no_telepon')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_pembelian')
                    ->required(),
                TextInput::make('alamat')
                    ->required()
                    ->maxLength(255),
                TextInput::make('qty')
                    ->required()
                    ->numeric()
                    ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                $subtotal = ($get('sell_price') ?? 0) * ($state ?? 0);
                                $set('total', $subtotal);

                                // hitung ulang total semua item
                                $items = $get('../../items'); // ambil semua item repeater
                                $grandTotal = collect($items)->sum('total');
                                $set('../../total', $grandTotal);
                            }),
                TextInput::make('hpp')
                    ->required()
                    ->numeric(),
                TextInput::make('sell_price')
                    ->required()
                    ->numeric(),
                TextInput::make('total')
                    ->required()
                    ->numeric(),
                TextInput::make('metode_pembayaran')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product_name')->label('Product Name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('sku')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('nama_supplier')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('no_telepon')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('tanggal_pembelian')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('alamat')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('qty')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('hpp')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('sell_price')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('total')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('metode_pembayaran')->sortable()->searchable(),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPembelians::route('/'),
            'create' => Pages\CreatePembelian::route('/create'),
            'edit' => Pages\EditPembelian::route('/{record}/edit'),
        ];
    }
}

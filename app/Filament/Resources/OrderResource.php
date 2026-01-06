<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Booking;
use App\Models\Order;
use App\Models\ProductStock as Product;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Sparepart & Layanan';
    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal'),
                Select::make('nomor_antrian')
                    ->label('No. Antrian')
                    ->options(Booking::query()->pluck('nomor_antrian', 'id'))
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        // Ambil product berdasarkan id yang dipilih
                        $booking = Booking::find($state);
                        // Isi otomatis field SKU
                        $set('customer_name', $booking?->nama_pelanggan ?? '');
                        $set('customer_phone', $booking?->no_telepon ?? '');
                    }),
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
                    ->columnSpanFull()
                    ->schema([
                        Select::make('product_name')
                            ->label('Produk')
                            ->options(Product::all()->pluck('product_name', 'product_name'))
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                $product = Product::where('product_name', $state)->first();
                                if ($product) {
                                    $set('sell_price', $product->sell_price);
                                    $set('sku', $product->sku);
                                    // reset quantity supaya perhitungan ulang
                                    $set('quantity', 0);
                                }
                            }),

                        Forms\Components\TextInput::make('sku')
                            ->label('SKU')
                            ->required(),

                        Forms\Components\TextInput::make('sell_price')
                            ->label('Harga Satuan')
                            ->numeric()
                            ->readOnly(),

                        Forms\Components\TextInput::make('quantity')
                            ->label('Jumlah')
                            ->numeric()
                            ->default(0)
                            ->minValue(1)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                $subtotal = ($get('sell_price') ?? 0) * ($state ?? 0);
                                $set('total_amount', $subtotal);

                                // hitung ulang total semua item
                                $items = $get('../../items'); // ambil semua item repeater
                                $grandTotal = collect($items)->sum('total_amount');
                                $set('../../total_amount', $grandTotal);
                            }),

                        Forms\Components\TextInput::make('total_amount')
                            ->label('Subtotal')
                            ->numeric()
                            ->readOnly(),
                    ])
                    ->columns(4)
                    ->createItemButtonLabel('Tambah Produk'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
         ->columns([
             Tables\Columns\TextColumn::make('tanggal')->label('Tanggal'),

             Tables\Columns\TextColumn::make('id')
                 ->label('Booking ID')
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
             Action::make('send_whatsapp')
    ->label('Kirim Invoice WA')
    ->icon('heroicon-o-phone')
    ->url(fn ($record) => route('invoice.send', $record))
    ->openUrlInNewTab()
    ->color('success'),
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

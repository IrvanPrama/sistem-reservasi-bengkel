<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderItemResource\Pages;
use App\Models\Booking;
use App\Models\OrderItem;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    protected static ?string $navigationLabel = 'Penjualan';
    protected static ?string $modelLabel = 'Penjualan';
    protected static ?string $pluralModelLabel = 'Penjualan';

    protected static ?string $navigationGroup = 'Transaksi';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal'),
                Forms\Components\Select::make('order_id')
                    ->options([
                        // Ambil data dari model Booking
                        Booking::all()->pluck('nomor_antrian', 'id')->toArray(),
                    ])
                    ->required(),
                Forms\Components\Select::make('product_name')
                    ->required()
                            ->reactive()

                    ->options([
                        // Ambil data dari model Product
                        Product::all()->pluck('product_name', 'product_name')->toArray(),
                    ])
                    ->afterStateUpdated(function ($state, callable $set, $get) {
                        $sellPrice = Product::where('product_name', $state)->first()->sell_price;
                        $set('sku', Product::where('product_name', $state)->first()->sku);
                        $set('sell_price', $sellPrice);
                    }),
                Forms\Components\TextInput::make('sku')
                     ->required(),
                Forms\Components\TextInput::make('sell_price')
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, $get) {
                        $sellPrice = $get('sell_price');
                        $grandTotal = ($sellPrice ?? 0) * ($state ?? 1);
                        $set('total_amount', $grandTotal);
                    }),

                Forms\Components\TextInput::make('total_amount')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        '0' => 'pending',
                        '1' => 'acc',
                    ])
                    ->required(),
                Forms\Components\FileUpload::make('bukti_pembayaran')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal')->label('Tanggal'),
                Tables\Columns\TextColumn::make('order_id')->label('Booking ID'),
                Tables\Columns\TextColumn::make('sku')->label('SKU'),
                Tables\Columns\TextColumn::make('product_name')->label('Product Name'),
                Tables\Columns\TextColumn::make('quantity')->label('Quantity'),
                Tables\Columns\TextColumn::make('sell_price')->label('Sell Price'),
                Tables\Columns\TextColumn::make('total_amount')->label('Total Price'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '0', 'pending' => 'warning',
                        '1', 'acc' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        '0' => 'Pending',
                        '1' => 'ACC',
                        default => ucfirst($state),
                    }),
                Tables\Columns\BadgeColumn::make('bukti_pembayaran')
                    ->label('Bukti Transfer')
                    ->colors([
                        'info',
                    ])
                    ->formatStateUsing(fn ($state) => $state ? 'Lihat Bukti' : '-')
                    ->url(fn ($record) => $record->bukti_pembayaran ? asset('storage/'.$record->bukti_pembayaran) : null)
                    ->openUrlInNewTab(),
            ])
            ->filters([
            ])
->actions([
    Tables\Actions\EditAction::make(),

    // Tombol ACC
    Tables\Actions\Action::make('acc')
        ->label('ACC')
        ->icon('heroicon-o-check-circle')
        ->color('success')
        ->requiresConfirmation()
        ->visible(fn ($record) => $record->status != '1')
        ->action(function ($record) {
            // Update status order item ke ACC
            $record->update(['status' => '1']);
        }),

    // Tombol Pending (jika ingin mengembalikan dari ACC ke Pending)
    Tables\Actions\Action::make('pending')
        ->label('Kembalikan ke Pending')
        ->icon('heroicon-o-arrow-path')
        ->color('warning')
        ->requiresConfirmation()
        ->visible(fn ($record) => $record->status == '1')
        ->action(function ($record) {
            // Update status order item ke Pending
            $record->update(['status' => '0']);
        }),
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
            'index' => Pages\ListOrderItems::route('/'),
            'create' => Pages\CreateOrderItem::route('/create'),
            'edit' => Pages\EditOrderItem::route('/{record}/edit'),
        ];
    }
}

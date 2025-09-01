<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockMovementResource\Pages;
use App\Filament\Resources\StockMovementResource\RelationManagers;
use App\Models\StockMovement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StockMovementResource extends Resource
{
    protected static ?string $model = StockMovement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Restock Produk';
    protected static ?string $pluralModelLabel = 'Restock Produk';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Select::make('product_id')
                ->label('Produk')
                ->relationship('product', 'product_name')
                ->searchable()
                ->required(),

            Forms\Components\TextInput::make('quantity')
                ->label('Jumlah Restock')
                ->numeric()
                ->minValue(1)
                ->required(),

            Forms\Components\Textarea::make('note')
                ->label('Catatan')
                ->placeholder('Contoh: Restock karena stok habis'),
        ])
        ->afterCreate(function ($record) {
            // update stok produk setiap kali restock dibuat
            $record->product->increment('stock', $record->quantity);

            Notification::make()
                ->title('Restock Berhasil')
                ->body("Stok untuk {$record->product->product_name} bertambah {$record->quantity}")
                ->success()
                ->send();
        });
}


    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.product_name')
                    ->label('Produk')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('Jumlah')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('note')
                    ->label('Catatan'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageStockMovements::route('/'),
        ];
    }
}

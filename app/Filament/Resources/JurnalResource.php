<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JurnalResource\Pages;
use App\Models\Jurnal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JurnalResource extends Resource
{
    protected static ?string $model = Jurnal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('type')->label('Tipe')->required(),
                Forms\Components\DatePicker::make('date')->label('Tanggal')->required(),
                Forms\Components\TextInput::make('product_name')->label('Nama Produk')->required(),
                Forms\Components\TextInput::make('pemasukan')->label('Pemasukan'),
                Forms\Components\TextInput::make('pengeluaran')->label('Pengeluaran'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')->label('Tipe'),
                Tables\Columns\TextColumn::make('date')->label('Tanggal')->date(),
                Tables\Columns\TextColumn::make('product_name')->label('Nama Produk'),
                Tables\Columns\TextColumn::make('pemasukan')->label('Pemasukan')
                  ->money('IDR')
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->label('Total Pemasukan')
                            ->money('IDR'),
                    ]),
                Tables\Columns\TextColumn::make('pengeluaran')->label('Pengeluaran')
                ->money('IDR')
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->label('Total Pengeluaran')
                            ->money('IDR'),
                    ]),
            ])
            ->filters([
            ])
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJurnals::route('/'),
            'create' => Pages\CreateJurnal::route('/create'),
            'edit' => Pages\EditJurnal::route('/{record}/edit'),
        ];
    }
}

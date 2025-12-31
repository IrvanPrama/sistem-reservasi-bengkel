<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LabaRugiResource\Pages;
use App\Models\LabaRugi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

class LabaRugiResource extends Resource
{
    protected static ?string $model = LabaRugi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?int $navigationSort = 20;
    protected static ?string $navigationLabel = 'Laba Rugi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('type')->label('Tipe')->required(),
                Forms\Components\DatePicker::make('date')->label('Tanggal')->required(),
                Forms\Components\TextInput::make('product_name')->label('Nama Produk')->required(),
                Forms\Components\Textarea::make('pemasukan')->label('Pemasukan'),
                Forms\Components\Textarea::make('pengeluaran')->label('Pengeluaran'),
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
                Filter::make('date')
                ->form([
                    Forms\Components\DatePicker::make('from')
                        ->label('Dari Tanggal'),
                    Forms\Components\DatePicker::make('until')
                        ->label('Sampai Tanggal'),
                ])
                ->query(function ($query, array $data) {
                    return $query
                        ->when($data['from'], fn ($q) => $q->whereDate('date', '>=', $data['from']))
                        ->when($data['until'], fn ($q) => $q->whereDate('date', '<=', $data['until']));
                }),
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
            'index' => Pages\ListLabaRugis::route('/'),
            'create' => Pages\CreateLabaRugi::route('/create'),
            'edit' => Pages\EditLabaRugi::route('/{record}/edit'),
        ];
    }
}

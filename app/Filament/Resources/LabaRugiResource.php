<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LabaRugiResource\Pages;
use App\Models\LabaRugi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LabaRugiResource extends Resource
{
    protected static ?string $model = LabaRugi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('type')->label('Tipe')->required(),
                Forms\Components\DatePicker::make('date')->label('Tanggal')->required(),
                Forms\Components\TextInput::make('product_name')->label('Nama Produk')->required(),
                Forms\Components\TextInput::make('total_amount')->label('Total Amount')->required()->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')->label('Tipe'),
                Tables\Columns\TextColumn::make('date')->label('Tanggal')->date(),
                Tables\Columns\TextColumn::make('product_name')->label('Nama Produk'),
                Tables\Columns\TextColumn::make('total_amount')->label('Total Amount')->money,
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
            'index' => Pages\ListLabaRugis::route('/'),
            'create' => Pages\CreateLabaRugi::route('/create'),
            'edit' => Pages\EditLabaRugi::route('/{record}/edit'),
        ];
    }
}

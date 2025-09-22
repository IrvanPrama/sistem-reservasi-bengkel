<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BebanusahaResource\Pages;
use App\Filament\Resources\BebanusahaResource\RelationManagers;
use App\Models\Bebanusaha;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BebanusahaResource extends Resource
{
    protected static ?string $model = Bebanusaha::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('Deskripsi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('Nominal')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Deskripsi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Nominal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBebanusahas::route('/'),
            'create' => Pages\CreateBebanusaha::route('/create'),
            'edit' => Pages\EditBebanusaha::route('/{record}/edit'),
        ];
    }
}

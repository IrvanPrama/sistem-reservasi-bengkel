<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CatatanItemResource\Pages;
use App\Models\CatatanItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CatatanItemResource extends Resource
{
    protected static ?string $model = CatatanItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?string $navigationLabel = 'Daftar Catatan';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('note_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('sub_type')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('category')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('note_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nominal')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\Textarea::make('item_description')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('note_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sub_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('note_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nominal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('item_description')
                    ->limit(50)
                    ->wrap(),
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
            'index' => Pages\ListCatatanItems::route('/'),
            'create' => Pages\CreateCatatanItem::route('/create'),
            'edit' => Pages\EditCatatanItem::route('/{record}/edit'),
        ];
    }
}

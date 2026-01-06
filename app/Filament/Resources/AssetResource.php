<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetResource\Pages;
use App\Models\Asset;
use App\Models\NeracaType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationLabel = 'Aset';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('nama')
                ->searchable()
                    ->options(
                        NeracaType::all()->where('type', 'asset')->pluck('category', 'category')->toArray()
                    )
                    ->reactive()
                    ->afterStateUpdated(function (Set $set, $state) {
                        $set(
                            'kategori',
                            NeracaType::where('category', $state)->value('sub_type')
                        );
                    }),
                Forms\Components\TextInput::make('kategori'),
                Forms\Components\TextInput::make('jumlah')
                    ->numeric(),
                Forms\Components\TextInput::make('nominal')
                    ->numeric()
                    ->reactive()
                    ->afterStateUpdated(function (Get $get, Set $set, $state) {
                        $jumlah = $get('jumlah') ?? 1;
                        $total_nominal = $state * $jumlah;
                        $set('total_nominal', $total_nominal);
                    }),
                Forms\Components\TextInput::make('total_nominal')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('kondisi')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal')
                 ->default(today()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jumlah')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nominal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_nominal')
                   ->numeric()
                   ->sortable(),
                Tables\Columns\TextColumn::make('kondisi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Periode')
                    ->date()
                    ->sortable(),
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
            'index' => Pages\ListAssets::route('/'),
            'create' => Pages\CreateAsset::route('/create'),
            'edit' => Pages\EditAsset::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CatatanResource\Pages;
use App\Models\Catatan;
use App\Models\NeracaType;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CatatanResource extends Resource
{
    protected static ?string $model = Catatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi')
                    ->required(),

                Forms\Components\Repeater::make('items')
                    ->relationship('items')
                    ->label('Masukan catatan')
                    ->schema([
                        Select::make('jenis')
                            ->label('Pilih Tipe')
                            ->options(NeracaType::all()->pluck('type', 'type'))
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (callable $set, $state) {
                                $type = NeracaType::where('type', $state)->first();
                                if ($type) {
                                    $set('sub_type', $type->sub_type);
                                    $set('category', $type->category);
                                } else {
                                    $set('sub_type', null);
                                    $set('category', null);
                                }
                            }),

                        Select::make('sub_type')
                            ->label('Sub Tipe')
                            ->options(function (callable $get) {
                                $jenis = $get('jenis');

                                return NeracaType::where('type', $jenis)->pluck('sub_type', 'sub_type');
                            })
                            ->searchable()
                            ->required()
                            ->reactive()
                        ->afterStateUpdated(function (callable $set, $state) {
                            $type = NeracaType::where('sub_type', $state)->first();
                            if ($type) {
                                $set('category', $type->category);
                            } else {
                                $set('category', null);
                            }
                        }),
                        Forms\Components\TextInput::make('category')
                             ->label('Kategori')
                             ->dehydrated(true),

                        Forms\Components\TextInput::make('note_title')
                            ->label('Judul Note'),

                        Forms\Components\TextInput::make('nominal')
                            ->label('Nominal')
                            ->numeric(),

                        Forms\Components\TextArea::make('item_description')
                            ->label('Deskripsi Note')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(4)
                    ->createItemButtonLabel('Tambah Note'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->limit(50),
                Tables\Columns\TextColumn::make('deskripsi')->limit(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Pages\ListCatatans::route('/'),
            'create' => Pages\CreateCatatan::route('/create'),
            'edit' => Pages\EditCatatan::route('/{record}/edit'),
        ];
    }
}

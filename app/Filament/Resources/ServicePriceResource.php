<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServicePriceResource\Pages;
use App\Models\ServicePrice;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServicePriceResource extends Resource
{
    protected static ?string $model = ServicePrice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\Select::make('service_name')
                    ->required()
                    ->options([
                        'Service Ringan' => 'Service Ringan',
                        'Service Berat' => 'Service Berat',
                        'Service Rutin' => 'Service Rutin',
                    ])

                    ->afterStateUpdated(function (callable $set, $state) {
                        $serviceNames = [
                            'Service Ringan' => 1,
                            'Service Berat' => 2,
                            'Service Rutin' => 3,
                        ];
                        $set('service_id', $serviceNames[$state] ?? '');
                    })
                    ->reactive(),
                Components\TextInput::make('service_id')
                    ->required()
                    ->maxLength(255),
                Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp ')
                    ->minValue(0),
                Components\TextInput::make('duration')
                    ->required(),
                Components\TextInput::make('duration_upto')
                    ->required(),
                Components\TextInput::make('workers')
                    ->required(),
                Components\TextInput::make('service_image')
                    ->required(),
                Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('service_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('idr', true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration')
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration_upto')
                    ->sortable(),
                Tables\Columns\TextColumn::make('workers')
                    ->sortable(),
                Tables\Columns\TextColumn::make('service_image')
                   ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->sortable(),
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
            'index' => Pages\ListServicePrices::route('/'),
            'create' => Pages\CreateServicePrice::route('/create'),
            'edit' => Pages\EditServicePrice::route('/{record}/edit'),
        ];
    }
}

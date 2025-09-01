<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Filament\Resources\ReservationResource\RelationManagers;
use App\Models\Reservation;
use App\Models\LapanganSchedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Carbon\Carbon;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('customer_name')
                ->label('Nama Penyewa')
                ->required(),

            Forms\Components\Select::make('field_id')
                ->label('Lapangan')
                ->relationship('lapangan', 'field_id') // pastikan relasi benar
                ->required(),

            Forms\Components\Grid::make(6)
                ->schema([
                    Forms\Components\DatePicker::make('date')
                        ->label('Hari Sewa')
                        ->required()
                        ->columnSpan(2),

                    Forms\Components\TimePicker::make('start_time')
                        ->label('Mulai Sewa')
                        ->required()
                        ->seconds(false)
                        ->columnSpan(2),

                    Forms\Components\TimePicker::make('end_time')
                        ->label('Selesai Sewa')
                        ->required()
                        ->after('start_time')
                        ->seconds(false)
                        ->columnSpan(2),
                ])
                ->columns(12),

            // total_amount otomatis
            Forms\Components\TextInput::make('total_amount')
                ->label('Total Bayar')
                ->disabled() // user tidak bisa input manual
                ->dehydrated(true) // tetap tersimpan ke DB
                ->live() // pantau perubahan field lain
                ->afterStateHydrated(function ($component, $state, Forms\Get $get) {
                    $start = $get('start_time');
                    $end = $get('end_time');
                    $fieldId = $get('field_id');

                    if (!$start || !$end || !$fieldId) {
                        return;
                    }

                    $startTime = \Carbon\Carbon::parse($start);
                    $endTime = \Carbon\Carbon::parse($end);
                    $hours = $endTime->diffInHours($startTime);

                    $hargaPerJam = \App\Models\Lapangan::find($fieldId)?->price ?? 0;
                    $total = $hours * $hargaPerJam;

                    $component->state($total);
                })
                ->formatStateUsing(fn ($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : null),

            Forms\Components\FileUpload::make('doc_tf')
                ->label('Bukti TF')
                ->directory('bukti-transfer'),

            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'booked' => 'Booked',
                    'cancelled' => 'Cancelled',
                ])
                ->default('booked'),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Nama Penyewa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('field_id')
                    ->label('Lapangan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->label('Mulai Sewa')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_time')
                    ->label('Selesai Sewa')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Tagihan')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')), 

                Tables\Columns\TextColumn::make('doc_tf')
                    ->label('Bukti TF'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}

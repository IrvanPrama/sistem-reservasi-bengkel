<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Booking';
    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_pelanggan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_telepon')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal')
                    ->required(),
                Forms\Components\TimePicker::make('jam_kedatangan')
                    ->required()
                    ->withoutSeconds(),
                Forms\Components\TextInput::make('merek')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_plat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tahun')
                    ->required(),
                Forms\Components\Textarea::make('keluhan')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('keterangan')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('estimasi_waktu')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('estimasi_biaya')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('pending'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_antrian')
                ->label('No. Antrian')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('nama_pelanggan')->searchable(),
                Tables\Columns\TextColumn::make('no_telepon')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tanggal')->date()->sortable(),
                Tables\Columns\TextColumn::make('jam_kedatangan'),
                Tables\Columns\TextColumn::make('no_plat')->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tahun')->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('estimasi_waktu')
                    ->label('Pengerjaan (hari)')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('estimasi_biaya')->money('idr', true)
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '0', 'pending' => 'warning',
                        '1', 'acc' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state) => $state == '1' ? 'ACC' : ucfirst($state)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                // Tombol ACC
                Tables\Actions\Action::make('acc')
                    ->label('ACC')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status != '1')
                    ->action(function ($record) {
                        $record->update(['status' => '1']);
                    }),

                // Tombol Kirim WA Konfirmasi
                Tables\Actions\Action::make('kirim_wa')
                    ->label('Kirim WA')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('info')
                    ->url(fn ($record) => 'https://wa.me/'.
                        $record->no_telepon
                        .'?text='
                        .urlencode("
Halo saya Admin, booking *{$record->nama_pelanggan}* sudah diterima.

Detail:
Nama: {$record->nama_pelanggan}
Tanggal: {$record->tanggal}
Jam: {$record->jam_kedatangan}
Merek: {$record->merek}
Plat: {$record->no_plat}

Silakan jawab ya untuk mengkonfirmasi kedatangan Anda. Terima kasih :D
            ")
                    )
                    ->openUrlInNewTab()

                    // Hanya tampil untuk login role 0 dan 1
                    ->visible(fn () => auth()->check() && in_array(auth()->user()->role, [0, 1])),

                // Opsional → Jika hanya muncul ketika status sudah ACC
                // ->visible(fn ($record) => $record->status == '1' && in_array(auth()->user()->role, [0, 1]))
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}

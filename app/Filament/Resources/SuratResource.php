<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuratResource\Pages;
use App\Filament\Resources\SuratResource\RelationManagers;
use App\Models\Surat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratResource extends Resource
{
    protected static ?string $model = \App\Models\Surat::class;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nomor_surat')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->label('Nomor Surat'),
                Forms\Components\TextInput::make('lokasi')
                    ->required()
                    ->label('Lokasi'),
                Forms\Components\DatePicker::make('tanggal')
                    ->required()
                    ->label('Tanggal'),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_surat'),
                Tables\Columns\TextColumn::make('lokasi'),
                Tables\Columns\TextColumn::make('tanggal')->date(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('download_surat')
                    ->label('Download Surat')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function ($record) {
                        $pdf = Pdf::loadView('surat.template', ['surat' => $record]);
                        return response()->streamDownload(
                            fn () => print($pdf->output()),
                            "Surat-Imunisasi-{$record->nomor_surat}.pdf"
                        );
                    }),
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
            'index' => Pages\ListSurats::route('/'),
            'create' => Pages\CreateSurat::route('/create'),
            'edit' => Pages\EditSurat::route('/{record}/edit'),
        ];
    }
}

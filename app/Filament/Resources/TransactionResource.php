<?php

namespace App\Filament\Resources;

use App\Models\Transaction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\Summarizers\Count;
use Illuminate\Database\Eloquent\Builder;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationLabel = 'Transaction Summary';

    protected static ?string $navigationGroup = 'Reports';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id'),
                Forms\Components\TextInput::make('banjar'),
                Forms\Components\TextInput::make('amount'),
                Forms\Components\TextInput::make('type'),
                Forms\Components\DatePicker::make('date'),
                Forms\Components\TextInput::make('status'),
                Forms\Components\Textarea::make('description'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->date('F Y') // tampilkan "Januari 2025"
                    ->label('Bulan')
                    ->sortable(),

                Tables\Columns\TextColumn::make('banjar')
                    ->label('Banjar')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('amount')
                    ->money('IDR')
                    ->label('Nominal')
                    ->summarize(Sum::make()->label('Total Penjualan')),

                Tables\Columns\TextColumn::make('id')
                    ->label('Transaksi')
                    ->summarize(Count::make()->label('Jumlah Transaksi')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('banjar')
                ->label('Banjar')
                ->options(
                    \App\Models\Transaction::query()
                        ->select('banjar')
                        ->distinct()
                        ->pluck('banjar', 'banjar')
                        ->toArray()
                )
                ->query(function ($query, array $data) {
                    if ($data['value']) {
                        $query->where('banjar', $data['value']);
                    }
                }),

                Tables\Filters\SelectFilter::make('year')
                    ->label('Tahun')
                    ->options(
                        \App\Models\Transaction::query()
                            ->selectRaw('YEAR(date) as year')
                            ->distinct()
                            ->orderBy('year', 'desc')
                            ->pluck('year', 'year')
                            ->toArray()
                    )
                    ->query(function ($query, array $data) {
                        if ($data['value']) {
                            $query->whereYear('date', $data['value']);
                        }
                    }),

            ])
            ->groups([
                Tables\Grouping\Group::make('date')
                    ->label('Per Bulan')
                    ->date('F Y')
                    ->collapsible(),
            ])
            ->defaultGroup('date')
            ->defaultSort('date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => TransactionResource\Pages\ListTransactions::route('/'),
        ];
    }
}

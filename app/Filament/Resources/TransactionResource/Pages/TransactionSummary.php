<?php

namespace App\Filament\Pages;

use App\Models\Transaction;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\Summarizers\Count;

class TransactionSummary extends Page implements HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Transaction Summary';
    protected static ?string $navigationGroup = 'Reports';
    protected static string $view = 'filament.pages.transaction-summary';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Transaction::query()
            )
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->date('F Y')
                    ->label('Bulan')
                    ->sortable(),

                Tables\Columns\TextColumn::make('banjar')
                    ->label('Banjar')
                    ->sortable(),

                Tables\Columns\TextColumn::make('amount')
                    ->money('IDR')
                    ->label('Nominal')
                    ->summarize(Sum::make()->label('Total Penjualan')),

                Tables\Columns\TextColumn::make('id')
                    ->label('Jumlah Transaksi')
                    ->summarize(Count::make()->label('Total Transaksi')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('banjar')
                    ->options(
                        Transaction::query()
                            ->select('banjar')
                            ->distinct()
                            ->pluck('banjar', 'banjar')
                    )
                    ->label('Filter Banjar'),

                Tables\Filters\SelectFilter::make('year')
                    ->options(
                        Transaction::query()
                            ->selectRaw('YEAR(date) as year')
                            ->distinct()
                            ->orderBy('year', 'desc')
                            ->pluck('year', 'year')
                    )
                    ->query(fn (Builder $query, $value) => $query->whereYear('date', $value))
                    ->label('Filter Tahun'),
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
}

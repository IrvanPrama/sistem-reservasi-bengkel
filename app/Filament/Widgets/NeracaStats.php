<?php

namespace App\Filament\Widgets;

use App\Models\Asset;
use App\Models\Equity;
use App\Models\LabaRugi;
use App\Models\Liability;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class NeracaStats extends BaseWidget
{
    // protected static ?string $heading = 'Ringkasan Keuangan';

    protected function getStats(): array
    {
        // Total Asset = jumlah * nominal
        $totalAsset = Asset::selectRaw('SUM(jumlah * nominal) AS total')->value('total') ?? 0;

        // Total Liability
        $totalLiability = Liability::sum('nominal') ?? 0;

        // Modal (Equity)
        $modal = Equity::sum('nominal') ?? 0;

        // Laba Ditahan
        $pemasukan = LabaRugi::sum('pemasukan');
        $pengeluaran = LabaRugi::sum('pengeluaran');
        $labaDitahan = $pemasukan - $pengeluaran;

        // Total Ekuitas
        $totalEquity = $modal + $labaDitahan;

        return [
            Stat::make('Total Aset', 'Rp '.number_format($totalAsset, 0, ',', '.'))
                ->description('Nilai seluruh aset perusahaan')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('success'),

            Stat::make('Total Liabilitas', 'Rp '.number_format($totalLiability, 0, ',', '.'))
                ->description('Total utang & kewajiban')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),

            Stat::make('Ekuitas', 'Rp '.number_format($totalEquity, 0, ',', '.'))
                ->description('Modal + Laba Ditahan')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('primary'),

            Stat::make('Laba Ditahan', 'Rp '.number_format($labaDitahan, 0, ',', '.'))
                ->description('Akumulasi keuntungan bersih')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color($labaDitahan >= 0 ? 'success' : 'danger'),
        ];
    }
}

<?php

namespace App\Filament\Pages;

use App\Models\Asset;
use App\Models\Equity;
use App\Models\LabaRugi;
use App\Models\Liability;
use Filament\Pages\Page;

class NeracaPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static string $view = 'filament.pages.neraca-page';
    protected static ?string $navigationLabel = 'Neraca';
    protected static ?string $navigationGroup = 'Laporan';

    public $totalAsset;
    public $totalLiability;
    public $totalEquity;
    public $labaDitahan;

    public function mount(): void
    {
        // Total Asset = jumlah * nominal
        $this->totalAsset = Asset::selectRaw('SUM(jumlah * nominal) AS total')->value('total');

        // Total Liability
        $this->totalLiability = Liability::sum('nominal');

        // Modal (equity table)
        $modal = Equity::sum('nominal');

        // Laba ditahan dari model LabaRugi
        $pemasukan = LabaRugi::sum('pemasukan');
        $pengeluaran = LabaRugi::sum('pengeluaran');

        $this->labaDitahan = $pemasukan - $pengeluaran;

        // Total ekuitas = modal + laba ditahan
        $this->totalEquity = $modal + $this->labaDitahan;
    }
}

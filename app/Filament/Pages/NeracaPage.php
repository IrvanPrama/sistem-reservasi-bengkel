<?php

namespace App\Filament\Pages;

use App\Models\Asset;
use App\Models\Equity;
use App\Models\LabaRugi;
use App\Models\Liability;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;

class NeracaPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static string $view = 'filament.pages.neraca-page';
    protected static ?string $navigationLabel = 'Neraca';
    protected static ?string $navigationGroup = 'Laporan';

    public $bulan;
    public $tahun;

    public $totalAsset;
    public $totalLiability;
    public $totalEquity;
    public $labaDitahan;

    public function mount(): void
    {
        $this->bulan = date('m');
        $this->tahun = date('Y');

        $this->hitung();
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('bulan')
                ->label('Bulan')
                ->options([
                    '01' => 'Januari',
                    '02' => 'Februari',
                    '03' => 'Maret',
                    '04' => 'April',
                    '05' => 'Mei',
                    '06' => 'Juni',
                    '07' => 'Juli',
                    '08' => 'Agustus',
                    '09' => 'September',
                    '10' => 'Oktober',
                    '11' => 'November',
                    '12' => 'Desember',
                ])
                ->reactive()
                ->afterStateUpdated(fn () => $this->hitung()),

            Forms\Components\Select::make('tahun')
                ->label('Tahun')
                ->options(
                    collect(range(date('Y') - 5, date('Y') + 1))
                        ->mapWithKeys(fn ($y) => [$y => $y])
                )
                ->reactive()
                ->afterStateUpdated(fn () => $this->hitung()),
        ];
    }

    public function hitung()
    {
        $dateColumn = 'tanggal';

        $this->totalAsset = Asset::whereMonth($dateColumn, $this->bulan)
            ->whereYear($dateColumn, $this->tahun)
            ->selectRaw('SUM(jumlah * nominal) AS total')
            ->value('total');

        $this->totalLiability = Liability::whereMonth($dateColumn, $this->bulan)
            ->whereYear($dateColumn, $this->tahun)
            ->sum('nominal');

        $modal = Equity::whereMonth($dateColumn, $this->bulan)
            ->whereYear($dateColumn, $this->tahun)
            ->sum('nominal');

        $pemasukan = LabaRugi::whereMonth($dateColumn, $this->bulan)
            ->whereYear($dateColumn, $this->tahun)
            ->sum('pemasukan');

        $pengeluaran = LabaRugi::whereMonth($dateColumn, $this->bulan)
            ->whereYear($dateColumn, $this->tahun)
            ->sum('pengeluaran');

        $this->labaDitahan = $pemasukan - $pengeluaran;

        $this->totalEquity = $modal + $this->labaDitahan;
    }
}

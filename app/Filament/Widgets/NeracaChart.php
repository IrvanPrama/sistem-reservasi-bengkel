<?php

namespace App\Filament\Widgets;

use App\Models\Asset;
use App\Models\Equity;
use App\Models\Liability;
use Filament\Forms;
use Filament\Widgets\ChartWidget;

class NeracaChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Neraca (Asset - Liability - Equity)';
    protected static ?int $sort = 1;

    public ?int $bulan = null;
    public ?int $tahun = null;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('bulan')
                ->label('Bulan')
                ->options([
                    1 => 'Januari',
                    2 => 'Februari',
                    3 => 'Maret',
                    4 => 'April',
                    5 => 'Mei',
                    6 => 'Juni',
                    7 => 'Juli',
                    8 => 'Agustus',
                    9 => 'September',
                    10 => 'Oktober',
                    11 => 'November',
                    12 => 'Desember',
                ])
                ->reactive(),

            Forms\Components\Select::make('tahun')
                ->label('Tahun')
                ->options(
                    range(2020, now()->year) // atau generate dinamis
                )
                ->reactive(),
        ];
    }

    protected function getData(): array
    {
        $queryAsset = Asset::query();
        $queryLiability = Liability::query();
        $queryEquity = Equity::query();

        // Filter berdasarkan bulan & tahun
        if ($this->bulan) {
            $queryAsset->whereMonth('date', $this->bulan);
            $queryLiability->whereMonth('jatuh_tempo', $this->bulan);
            $queryEquity->whereMonth('created_at', $this->bulan);
        }

        if ($this->tahun) {
            $queryAsset->whereYear('date', $this->tahun);
            $queryLiability->whereYear('jatuh_tempo', $this->tahun);
            $queryEquity->whereYear('created_at', $this->tahun);
        }

        // Hitung nilai
        $totalAsset = $queryAsset->selectRaw('SUM(jumlah * nominal) AS total')->value('total') ?? 0;
        $totalLiability = $queryLiability->sum('nominal') ?? 0;
        $totalEquity = $queryEquity->sum('nominal') ?? 0;

        return [
            'datasets' => [
                [
                    'label' => 'Neraca',
                    'data' => [
                        $totalAsset,
                        $totalLiability,
                        $totalEquity,
                    ],
                ],
            ],
            'labels' => ['Asset', 'Liability', 'Equity'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

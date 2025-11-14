<x-filament::page>

    <h2 class="text-xl font-bold mb-4">Laporan Neraca</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- ASET --}}
        <div class="p-4 bg-warning rounded shadow">
            <h3 class="font-semibold text-lg mb-2">Total Aset</h3>
            <p class="text-xl font-bold">
                Rp {{ number_format($totalAsset, 0, ',', '.') }}
            </p>
        </div>

        {{-- LIABILITAS --}}
        <div class="p-4 bg-warning rounded shadow">
            <h3 class="font-semibold text-lg mb-2">Total Liabilitas</h3>
            <p class="text-xl font-bold">
                Rp {{ number_format($totalLiability, 0, ',', '.') }}
            </p>
        </div>

        {{-- EKUITAS --}}
        <div class="p-4 bg-warning rounded shadow">
            <h3 class="font-semibold text-lg mb-2">Total Ekuitas</h3>
            <p class="text-xl font-bold">
                Rp {{ number_format($totalEquity, 0, ',', '.') }}
            </p>
        </div>

    </div>

    <div class="mt-6 p-4 bg-warning rounded shadow">
        <h3 class="font-semibold text-lg mb-2">Laba Ditahan</h3>
        <p class="text-xl font-bold">
            Rp {{ number_format($labaDitahan, 0, ',', '.') }}
        </p>
    </div>

</x-filament::page>

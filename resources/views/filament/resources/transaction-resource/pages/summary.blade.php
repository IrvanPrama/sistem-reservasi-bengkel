<x-filament::page>
    <form method="GET">
        <label for="year">Pilih Tahun:</label>
        <select id="year" name="year" onchange="this.form.submit()">
            @for ($y = date('Y'); $y >= 2020; $y--)
                <option value="{{ $y }}" {{ request('year', date('Y')) == $y ? 'selected' : '' }}>
                    {{ $y }}
                </option>
            @endfor
        </select>
    </form>

    @php
        $year = request('year', date('Y'));
        $summary = \App\Models\Transaction::select(
                DB::raw('MONTH(date) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->whereYear('date', $year)
            ->where('type', 'penjualan')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    @endphp

    <table class="table-auto w-full border-collapse border border-gray-300 mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Bulan</th>
                <th class="border px-4 py-2">Total Penjualan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($summary as $row)
                <tr>
                    <td class="border px-4 py-2">
                        {{ \Carbon\Carbon::create()->month($row->month)->translatedFormat('F') }}
                    </td>
                    <td class="border px-4 py-2">
                        Rp {{ number_format($row->total, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-filament::page>

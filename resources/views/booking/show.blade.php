@extends('layouts.app')

@section('content')
<div class="px-5 flex justify-center fade">

    <div class="w-full max-w-2xl bg-white/10 backdrop-blur-xl 
                border border-white/20 rounded-2xl p-7 shadow-[0_10px_40px_rgba(0,0,0,0.45)]">

        <h2 class="text-center text-3xl font-bold text-white mb-6 tracking-wide">
            Detail Reservasi
        </h2>

        <!-- SUCCESS ALERT -->
        @if(session('success'))
            <div class="bg-green-600 text-white font-semibold p-3 rounded text-center mb-5">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card Detail -->
        <div class="space-y-4">

            @php
                $items = [
                    'Nama Pelanggan' => $booking->nama_pelanggan,
                    'Nomor Telepon / WA' => $booking->no_telepon,
                    'Email' => $booking->email ?? '-',
                    'Alamat' => $booking->alamat ?? '-',
                    'Merek Kendaraan' => $booking->merek,
                    'Nomor Plat' => $booking->no_plat ?? '-',
                    'Tahun Kendaraan' => $booking->tahun ?? '-',
                    'Keluhan' => $booking->keluhan ?? '-',
                    'Tanggal' => $booking->tanggal,
                    'Jam Kedatangan' => $booking->jam_kedatangan,
                    'Catatan Tambahan' => $booking->keterangan ?? '-',
                ];
            @endphp

            @foreach($items as $label => $value)
                <div class="bg-white/90 rounded-xl p-4 border-l-4 border-yellow-400 
                            shadow hover:scale-[1.01] transition-all duration-300">
                    <p class="text-blue-900 font-bold text-sm tracking-wide">{{ $label }}</p>
                    <p class="text-gray-800 text-base mt-1">{{ $value }}</p>
                </div>
            @endforeach

        </div>
            <!-- $adminPhone = '6281234567890';
 -->
        <!-- Tombol WA -->
        @php

            $pesan = urlencode("
Halo Admin, ada reservasi baru:

Nama: $booking->nama_pelanggan
Tanggal: $booking->tanggal
Jam: $booking->jam_kedatangan
Merek: $booking->merek
Plat: $booking->no_plat

Terima kasih.
");
        @endphp

        <a href="https://wa.me/{{ $adminPhone }}?text={{ $pesan }}"
           target="_blank"
           class="block w-full mt-7 bg-green-500 hover:bg-green-400 text-white 
                  text-lg font-bold py-3 rounded-xl text-center shadow-lg 
                  hover:scale-[1.03] transition-all">
            Kirim WhatsApp ke Admin
        </a>

        <!-- Tombol kembali -->
        <a href="/booking"
           class="block w-full mt-3 bg-white/80 hover:bg-white text-blue-900 
                  text-lg font-semibold py-3 rounded-xl text-center shadow 
                  hover:scale-[1.02] transition-all">
            Kembali ke Form Reservasi
        </a>

    </div>
</div>
@endsection

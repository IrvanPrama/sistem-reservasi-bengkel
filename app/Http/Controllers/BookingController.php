<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Dataset;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nama_pelanggan' => 'required|string|max:255',
                'no_telepon' => 'required|string|max:20',
                'email' => 'nullable|email|max:255',
                'alamat' => 'nullable|string|max:500',
                'tanggal' => 'required',
                'jam_kedatangan' => 'required',
                'merek' => 'required|string|max:100',
                'no_plat' => 'nullable|string|max:20',
                'tahun' => 'nullable|string|max:100',
                'keluhan' => 'nullable|string|max:1000',
                'keterangan' => 'nullable|string|max:1000',
                'status' => 'nullable|string|max:50',
            ]);

            $booking = Booking::create($data);

            return redirect()->route('booking.show', $booking->id)
                ->with('success', 'Booking berhasil dibuat!');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['gagal' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        // $adminPhone = Dataset::where('type', 'wa_admin')->first();
        $adminPhone = Dataset::where('type', 'wa_admin')->value('value');

        return view('booking.show', compact('booking', 'adminPhone'));
    }
}

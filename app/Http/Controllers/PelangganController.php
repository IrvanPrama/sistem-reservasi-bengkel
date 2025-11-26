<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        return view('pelanggan.register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:pelanggans,email',
            'alamat' => 'required|string|max:500',
            'merek' => 'required|string|max:100',
            'no_plat' => 'required|string|max:20',
            'tahun' => 'required|integer|min:1900',
        ]);

        Pelanggan::create($data);

        return redirect()->back()->with('success', 'Pendaftaran Member Berhasil! Anda kini menjadi member Bengkel Bagus 🚗🔥');
    }
}

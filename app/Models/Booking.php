<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Booking extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'nomor_antrian',
        'nama_pelanggan',
        'no_telepon',
        'email',
        'alamat',
        'tanggal',
        'jam_kedatangan',
        'merek',
        'no_plat',
        'tahun',
        'keluhan',
        'keterangan',
        'estimasi_waktu',
        'estimasi_biaya',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($booking) {
            $latest = Booking::max('nomor_antrian');
            $booking->nomor_antrian = $latest ? $latest + 1 : 1;
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory, Notifiable;
     protected $fillable = [
            'id_booking',
            'nama_pelanggan',
            'no_telepon',
            'email',
            'alamat',
            'tanggal',
            'jam_kedatangan',
            'merek',
            'no_plat',
            'tahun',
            'layanan',
            'keterangan',
            'estimasi_waktu',
            'estimasi_biaya',
            'status',

            

    ];
        
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory, Notifiable;
     protected $fillable = [
            'nama_pelanggan',
            'no_telepon',
            'email',
            'alamat',
            'merek',
            'no_plat',
            'tanggal_booking',
            'jenis_layanan',
            'layanan_tambahan',
            'item_terpilih',
            'subtotal', 
            'jasa', 
            'total', 
            'metode_pembayaran',      
     ];
}

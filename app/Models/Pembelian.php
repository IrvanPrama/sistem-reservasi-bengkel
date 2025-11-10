<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pembelian extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'sku',
        'product_name',
        'nama_supplier',
        'no_telepon',
        'email',
        'tanggal_pembelian',
        'alamat',
        'qty',
        'hpp',
        'sell_price',
        'total',
        'metode_pembayaran',
    ];
}

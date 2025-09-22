<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Pembelian extends Model
{
    use HasFactory, Notifiable;
     protected $fillable = [
            'nama_suppplier',
            'no_telepon',
            'email',
            'alamat',
            'item_terpilih',
            'subtotal', 
            'diskon', 
            'total', 
            'metode_pembayaran', 
     ];   
}

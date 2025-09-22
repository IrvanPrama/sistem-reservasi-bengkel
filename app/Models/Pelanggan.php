<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Pelanggan extends Model
{
    use HasFactory, Notifiable;
     protected $fillable = [
            'nama_pelanggan',
            'no_telepon',
            'email',
            'alamat',
            'merek',
            'no_plat',
            'tahun',          

    ];
}

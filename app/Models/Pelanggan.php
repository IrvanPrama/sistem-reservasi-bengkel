<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pelanggan extends Model
{
    use HasFactory;
    use Notifiable;
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

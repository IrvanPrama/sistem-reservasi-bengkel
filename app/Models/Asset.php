<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Asset extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'nama',
        'kategori',
        'jumlah',
        'nominal',
        'kondisi',
        'date',
    ];
}

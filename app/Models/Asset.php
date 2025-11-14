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
        'sku',
        'nama',
        'kategori',
        'jumlah',
        'nominal',
        'total_nominal',
        'kondisi',
        'date',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surats';
    protected $fillable = [
        'nomor_surat',
        'lokasi',
        'tanggal',
    ];
}

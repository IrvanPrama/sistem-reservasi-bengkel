<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class Lapangan extends Model
{
    use HasFactory;

    protected $table = 'lapangan';
    protected $fillable = [
        'field_id',
        'lapangan_name',
        'price_per_hour',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'field_id');
    }
}

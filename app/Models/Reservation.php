<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lapangan;


class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $fillable = [
        'customer_name',
        'field_id',
        'date',
        'start_time',
        'end_time',
        'total_amount',
        'doc_tf',
        'status',
    ];

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class, 'field_id');
    }   
}

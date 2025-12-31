<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePrice extends Model
{
    protected $table = 'service_prices';

    protected $fillable = [
        'service_id',
        'service_name',
        'price',
        'duration',
        'duration_upto',
        'workers',
        'service_image',
        'description',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

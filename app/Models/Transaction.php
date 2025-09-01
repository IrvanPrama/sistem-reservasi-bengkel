<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'banjar',
        'amount',
        'type',
        'date',
        'status',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

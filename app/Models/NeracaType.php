<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class NeracaType extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'type',
        'sub_type',
        'category',
    ];
}

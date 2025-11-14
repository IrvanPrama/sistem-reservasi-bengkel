<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CatatanItem extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'note_id',
        'note_title',
        'sub_type',
        'category',
        'nominal',
        'item_description',
    ];
}

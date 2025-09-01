<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionSummary extends Model
{
    public $incrementing = false; // penting: id tidak auto increment
    protected $keyType = 'string'; // id berbentuk string
    public $timestamps = false;
    protected $guarded = [];
}

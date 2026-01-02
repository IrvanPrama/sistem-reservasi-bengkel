<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class LabaRugi extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'type',
        'tanggal',
        'order_item_id',
        'product_name',
        'pemasukan',
        'pengeluaran',
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
}

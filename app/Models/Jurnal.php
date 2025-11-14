<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $fillable = [
        'type',
        'date',
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

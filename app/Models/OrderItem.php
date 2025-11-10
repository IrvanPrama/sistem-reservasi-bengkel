<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'sku',
        'product_name',
        'quantity',
        'sell_price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'sku');
    }

    // Membuat Stock Movement
    protected static function booted()
    {
        static::created(function ($item) {
            if ($item->product) {
                // update sold_qty
                $item->product->increment('sold_qty', $item->quantity);

                // catat pergerakan stok keluar
                StockMovement::create([
                    'sku' => $item->sku,
                    'type' => 'out',
                    'quantity' => $item->quantity,
                    'note' => 'Order #'.$item->order_id,
                ]);
            }
        });
    }
}

<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'total_amount',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    protected static function booted()
    {
        static::saved(function ($order) {
            $total = $order->items()->with('product')->get()->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

            if ($order->total_amount !== $total) {
                $order->total_amount = $total;
                $order->saveQuietly(); // supaya tidak infinite loop
            }
        });
    }

}

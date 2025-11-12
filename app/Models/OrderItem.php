<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'sku',
        'product_name',
        'quantity',
        'sell_price',
        'status',
    ];

    protected static function booted()
    {
        static::updating(function ($orderItem) {
            // Ambil data lama sebelum update
            $oldStatus = $orderItem->getOriginal('status');
            $oldQuantity = $orderItem->getOriginal('quantity');

            // Ambil stok produk berdasarkan SKU
            $productStock = ProductStock::where('sku', $orderItem->sku)->first();

            if (!$productStock) {
                return;
            }

            // CASE 1: status berubah dari pending → acc
            if ($oldStatus == '0' && $orderItem->status == '1') {
                if ($productStock->quantity < $orderItem->quantity) {
                    throw new \Exception("Stok tidak cukup untuk produk {$orderItem->sku}");
                }

                $productStock->decrement('quantity', $orderItem->quantity);
            }

            // CASE 2: status berubah dari acc → pending
            elseif ($oldStatus == '1' && $orderItem->status == '0') {
                $productStock->increment('quantity', $orderItem->quantity);
            }

            // CASE 3: status tetap acc tapi quantity berubah → sesuaikan selisih
            elseif ($oldStatus == '1' && $orderItem->status == '1' && $oldQuantity != $orderItem->quantity) {
                $selisih = $orderItem->quantity - $oldQuantity;

                if ($selisih > 0) {
                    if ($productStock->quantity < $orderItem->quantity) {
                        throw new \Exception("Stok tidak cukup untuk produk {$orderItem->sku}");
                    }

                    // Quantity bertambah → stok dikurangi lagi
                    $productStock->decrement('quantity', $selisih);
                } else {
                    // Quantity berkurang → stok dikembalikan sebagian
                    $productStock->increment('quantity', abs($selisih));
                }
            }
        });
    }
}

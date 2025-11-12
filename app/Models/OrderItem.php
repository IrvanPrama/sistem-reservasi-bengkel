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
        'total_amount',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'sku', 'sku');
    }

    public function labaRugi()
    {
        return $this->hasOne(LabaRugi::class, 'order_item_id');
    }

    protected static function booted()
    {
        static::updating(function ($orderItem) {
            $oldStatus = $orderItem->getOriginal('status');
            $oldQuantity = $orderItem->getOriginal('quantity');

            $productStock = ProductStock::where('sku', $orderItem->sku)->first();

            if (!$productStock) {
                return;
            }

            // CASE 1: pending → acc
            if ($oldStatus == '0' && $orderItem->status == '1') {
                if ($productStock->quantity < $orderItem->quantity) {
                    throw new \Exception("Stok tidak cukup untuk produk {$orderItem->sku}");
                }

                $productStock->decrement('quantity', $orderItem->quantity);

                // Tambahkan data ke laba_rugi
                LabaRugi::create([
                    'type' => 'penjualan',
                    'date' => now(),
                    'order_item_id' => $orderItem->id,
                    'product_name' => $orderItem->product_name,
                    'total_amount' => $orderItem->total_amount,
                ]);
            }

            // CASE 2: acc → pending
            elseif ($oldStatus == '1' && $orderItem->status == '0') {
                $productStock->increment('quantity', $orderItem->quantity);

                // Hapus data laba_rugi terkait (opsional)
                $orderItem->labaRugi()->delete();
            }

            // CASE 3: acc → acc (quantity berubah)
            elseif ($oldStatus == '1' && $orderItem->status == '1' && $oldQuantity != $orderItem->quantity) {
                $selisih = $orderItem->quantity - $oldQuantity;

                if ($selisih > 0) {
                    if ($productStock->quantity < $selisih) {
                        throw new \Exception("Stok tidak cukup untuk produk {$orderItem->sku}");
                    }

                    $productStock->decrement('quantity', $selisih);
                } else {
                    $productStock->increment('quantity', abs($selisih));
                }

                // Update juga data laba_rugi
                $orderItem->labaRugi()->update([
                    'quantity' => $orderItem->quantity,
                    'total_amount' => $orderItem->total_amount,
                ]);
            }
        });
    }
}

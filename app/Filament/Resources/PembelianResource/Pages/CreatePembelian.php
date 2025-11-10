<?php

namespace App\Filament\Resources\PembelianResource\Pages;

use App\Filament\Resources\PembelianResource;
use App\Models\ProductStock;
use Filament\Resources\Pages\CreateRecord;

class CreatePembelian extends CreateRecord
{
    protected static string $resource = PembelianResource::class;

    protected function afterCreate(): void
    {
        $pembelian = $this->record;

        // Cek apakah produk sudah ada di tabel product_stocks
        $productStock = ProductStock::where('sku', $pembelian->sku)->first();

        if ($productStock) {
            // Jika sudah ada, update quantity dengan menambahkan qty pembelian
            $productStock->increment('quantity', $pembelian->qty);

            // (opsional) update harga jual jika ingin sinkron dengan pembelian terbaru
            $productStock->update([
                'sell_price' => $pembelian->sell_price,
            ]);
        } else {
            // Jika produk belum ada, buat data baru
            ProductStock::create([
                'product_name' => $pembelian->product_name,
                'sku' => $pembelian->sku,
                'quantity' => $pembelian->qty,
                'sell_price' => $pembelian->sell_price,
            ]);
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

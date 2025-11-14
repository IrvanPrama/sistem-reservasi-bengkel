<?php

namespace App\Filament\Resources\PembelianResource\Pages;

use App\Filament\Resources\PembelianResource;
use App\Models\Asset;
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
        $productAsset = Asset::where('sku', $pembelian->sku)->first();

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

        if ($productAsset) {
            // Jika sudah ada, update quantity dengan menambahkan qty pembelian
            $productAsset->increment('jumlah', $pembelian->qty);

            // (opsional) update harga jual jika ingin sinkron dengan pembelian terbaru
            $productAsset->update([
                'nominal' => $pembelian->hpp,
            ]);
        } else {
            // Jika produk belum ada, buat data baru
            Asset::create([
                'nama' => $pembelian->product_name,
                'sku' => $pembelian->sku,
                'jumlah' => $pembelian->qty,
                'nominal' => $pembelian->hpp,
                'kategori' => 'Asset Lancar',
                'kondisi' => 'Baik',
                'date' => $pembelian->tanggal_pembelian,
            ]);
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

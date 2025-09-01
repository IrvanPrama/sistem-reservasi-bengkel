<?php

namespace App\Filament\Resources\StockMovementResource\Pages;

use App\Filament\Resources\StockMovementResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Notifications\Notification;

class ManageStockMovements extends ManageRecords
{
    protected static string $resource = StockMovementResource::class;
    protected static bool $canCreate = true;
    protected static ?string $createButtonLabel = 'Tambah Restock';


   protected function afterCreate(): void
    {
        $record = $this->record;

        if ($record->product) {
            // update stok produk
            $record->product->increment('stock', $record->quantity);

            Notification::make()
                ->title('Restock Berhasil')
                ->body("Stok untuk {$record->product->product_name} bertambah {$record->quantity}")
                ->success()
                ->send();
        }
    }
}

<?php

namespace App\Filament\Resources\CatatanItemResource\Pages;

use App\Filament\Resources\CatatanItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCatatanItems extends ListRecords
{
    protected static string $resource = CatatanItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}

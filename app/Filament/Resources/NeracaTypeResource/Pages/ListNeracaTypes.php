<?php

namespace App\Filament\Resources\NeracaTypeResource\Pages;

use App\Filament\Resources\NeracaTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNeracaTypes extends ListRecords
{
    protected static string $resource = NeracaTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

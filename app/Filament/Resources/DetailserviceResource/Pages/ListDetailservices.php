<?php

namespace App\Filament\Resources\DetailserviceResource\Pages;

use App\Filament\Resources\DetailserviceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDetailservices extends ListRecords
{
    protected static string $resource = DetailserviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

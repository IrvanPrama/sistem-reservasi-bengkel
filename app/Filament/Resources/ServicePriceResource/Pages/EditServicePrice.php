<?php

namespace App\Filament\Resources\ServicePriceResource\Pages;

use App\Filament\Resources\ServicePriceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServicePrice extends EditRecord
{
    protected static string $resource = ServicePriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\BebanusahaResource\Pages;

use App\Filament\Resources\BebanusahaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBebanusaha extends EditRecord
{
    protected static string $resource = BebanusahaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

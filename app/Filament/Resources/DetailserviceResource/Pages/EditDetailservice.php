<?php

namespace App\Filament\Resources\DetailserviceResource\Pages;

use App\Filament\Resources\DetailserviceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDetailservice extends EditRecord
{
    protected static string $resource = DetailserviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

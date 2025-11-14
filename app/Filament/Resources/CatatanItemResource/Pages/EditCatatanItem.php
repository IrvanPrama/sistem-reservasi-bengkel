<?php

namespace App\Filament\Resources\CatatanItemResource\Pages;

use App\Filament\Resources\CatatanItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCatatanItem extends EditRecord
{
    protected static string $resource = CatatanItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

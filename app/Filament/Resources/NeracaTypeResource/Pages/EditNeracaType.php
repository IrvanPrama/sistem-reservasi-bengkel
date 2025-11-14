<?php

namespace App\Filament\Resources\NeracaTypeResource\Pages;

use App\Filament\Resources\NeracaTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNeracaType extends EditRecord
{
    protected static string $resource = NeracaTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

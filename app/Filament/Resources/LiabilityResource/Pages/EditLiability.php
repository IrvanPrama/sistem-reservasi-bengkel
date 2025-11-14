<?php

namespace App\Filament\Resources\LiabilityResource\Pages;

use App\Filament\Resources\LiabilityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLiability extends EditRecord
{
    protected static string $resource = LiabilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\LockerTypeResource\Pages;

use App\Filament\Resources\LockerTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLockerType extends ViewRecord
{
    protected static string $resource = LockerTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

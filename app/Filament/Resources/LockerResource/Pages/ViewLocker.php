<?php

namespace App\Filament\Resources\LockerResource\Pages;

use App\Filament\Resources\LockerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLocker extends ViewRecord
{
    protected static string $resource = LockerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

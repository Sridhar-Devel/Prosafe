<?php

namespace App\Filament\Resources\TennureResource\Pages;

use App\Filament\Resources\TennureResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTennure extends ViewRecord
{
    protected static string $resource = TennureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

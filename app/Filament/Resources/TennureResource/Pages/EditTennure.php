<?php

namespace App\Filament\Resources\TennureResource\Pages;

use App\Filament\Resources\TennureResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTennure extends EditRecord
{
    protected static string $resource = TennureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}

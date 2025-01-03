<?php

namespace App\Filament\Resources\LockerTypeResource\Pages;

use App\Filament\Resources\LockerTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLockerType extends EditRecord
{
    protected static string $resource = LockerTypeResource::class;

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

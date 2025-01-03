<?php

namespace App\Filament\Resources\ProofTypeResource\Pages;

use App\Filament\Resources\ProofTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProofType extends ViewRecord
{
    protected static string $resource = ProofTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

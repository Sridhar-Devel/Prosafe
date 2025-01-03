<?php

namespace App\Filament\Resources\ProofTypeResource\Pages;

use App\Filament\Resources\ProofTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProofTypes extends ListRecords
{
    protected static string $resource = ProofTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

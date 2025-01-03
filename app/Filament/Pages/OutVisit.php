<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\OutVisitEntry;
use Filament\Pages\Page;

class OutVisit extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-arrow-right-on-rectangle';

    protected static string $view = 'filament.pages.out-visit-entry';

    protected function getHeaderWidgets(): array
    {
        return [
            OutVisitEntry::class,
        ];
    }
}

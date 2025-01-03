<?php

namespace App\Filament\Widgets;

use App\Models\Visit;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class OutVisitEntry extends BaseWidget
{
    /**
     * @var int|string|array<string, int>
     */
    protected int|string|array $columnSpan = 'full';

    protected static ?string $title = 'Out Visit Entry';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Visit::query()
                    ->where('time_out', null)
                    ->orderBy('created_at', 'asc')
            )
            ->columns([
                TextColumn::make('customer.customer_name')
                    ->label('Customer 1')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('customer2.customer_name')
                    ->label('Customer 2')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('customer3.customer_name')
                    ->label('Customer 3')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('locker.number')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('locker.floor.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('time_in')
                    ->label('In Time')
                    ->sortable()
                    ->searchable(),
                CheckboxColumn::make('time_out')
                    ->label('Out Time'),
                TextColumn::make('user.name')
                    ->sortable()
                    ->searchable(),
            ]);
    }
}

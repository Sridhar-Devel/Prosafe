<?php

namespace App\Filament\Resources\LockerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VisitsRelationManager extends RelationManager
{
    protected static string $relationship = 'visits';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('locker_id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('locker_id')
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
                TextColumn::make('time_out')
                    ->label('Out Time')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

<?php

namespace App\Filament\Resources\LockerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AgreementRelationManager extends RelationManager
{
    protected static string $relationship = 'agreement';

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
                TextColumn::make('agreement_no'),
                TextColumn::make('locker.number'),
                TextColumn::make('locker.floor.name'),
                TextColumn::make('status'),
                TextColumn::make('operation_type'),
                TextColumn::make('start_date')->date('Y-m-d'),
                TextColumn::make('end_date')->date('Y-m-d'),
                TextColumn::make('customer1.customer_name'),
                TextColumn::make('customer2.customer_name'),
                TextColumn::make('customer3.customer_name'),
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

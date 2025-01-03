<?php

namespace App\Filament\Resources\AgreementResource\RelationManagers;

use App\Models\Status;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LockerRelationManager extends RelationManager
{
    protected static string $relationship = 'locker';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('number')
                    ->required()
                    ->maxLength(10),
                Select::make('floor_id')
                    ->relationship('floor', 'name')
                    ->native(false)
                    ->required(),
                Select::make('status_id')
                    ->relationship('status', 'name')
                    ->native(false)
                    ->default(Status::where('name', 'Available')->value('id'))
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('locker_id')
            ->columns([
                TextColumn::make('number'),
                TextColumn::make('floor.name'),
                TextColumn::make('status.name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

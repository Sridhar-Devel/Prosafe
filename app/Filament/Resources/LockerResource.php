<?php

namespace App\Filament\Resources;

use App\Enums\StatusEnum;
use App\Filament\Resources\LockerResource\Pages;
use App\Filament\Resources\LockerResource\RelationManagers\AgreementRelationManager;
use App\Filament\Resources\LockerResource\RelationManagers\VisitsRelationManager;
use App\Models\Locker;
use App\Models\LockerType;
use App\Models\Status;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Tapp\FilamentAuditing\RelationManagers\AuditsRelationManager;

class LockerResource extends Resource
{
    protected static ?string $model = Locker::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationGroup = 'Locker Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Locker Details')
                    ->schema([
                        TextInput::make('number')
                            ->required()
                            ->maxLength(10),
                        Select::make('floor_id')
                            ->relationship('floor', 'name')
                            ->native(false)
                            ->required(),
                        Select::make('locker_type_id')
                            ->options(LockerType::where('status', StatusEnum::Active)->pluck('name', 'id'))
                            ->label('Locker Type')
                            ->native(false)
                            ->required(),
                        TextInput::make('key_no')
                            ->required()
                            // ->unique(ignoreRecord: true)
                            ->maxLength(10),

                        Select::make('status_id')
                            ->relationship('status', 'name')
                            ->native(false)
                            ->default(Status::where('name', 'Available')->value('id'))
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('number')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('floor.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('locker_type.name')
                    ->searchable(),
                TextColumn::make('key_no')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status.name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            VisitsRelationManager::class,
            AgreementRelationManager::class,
            // AuditsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLockers::route('/'),
            'create' => Pages\CreateLocker::route('/create'),
            'view' => Pages\ViewLocker::route('/{record}'),
            'edit' => Pages\EditLocker::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }
}

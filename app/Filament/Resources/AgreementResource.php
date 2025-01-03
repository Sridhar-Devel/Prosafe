<?php

namespace App\Filament\Resources;

use App\Enums\NomineeRelationEnum;
use App\Enums\OperationTypeEnum;
use App\Enums\StatusEnum;
use App\Filament\Resources\AgreementResource\Pages;
use App\Filament\Resources\AgreementResource\RelationManagers\LockerRelationManager;
use App\Filament\Resources\AgreementResource\RelationManagers\TennuresRelationManager;
use App\Models\Agreement;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class AgreementResource extends Resource
{
    protected static ?string $model = Agreement::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Documents';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Agreement Details')
                    ->schema([
                        TextInput::make('agreement_no')
                            ->autofocus()
                            ->required()
                            ->live()
                            ->unique(ignoreRecord: true)
                            ->label('Agreement No'),

                        FileUpload::make('agreement_proof')
                            ->acceptedFileTypes(['application/pdf'])
                            ->helperText('Only PDF files are allowed')
                            ->disk('documents')
                            ->directory(fn (Get $get) => 'agreements/'.$get('agreement_no'))
                            ->required()
                            ->downloadable()
                            ->openable()
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, Get $get): string {
                                $agreement_no = $get('agreement_no');
                                $file_ext = $file->getClientOriginalExtension();

                                return "agreement-{$agreement_no}.{$file_ext}";
                            })
                            ->label('Agreement Scanned Copy'),

                        Select::make('locker_id')
                            ->options(fn (Get $get) => Agreement::locker_search($get('agreement_no')))
                            ->searchable()
                            ->native(false)
                            ->required()
                            ->label('Locker'),

                        DatePicker::make('start_date')
                            ->required()
                            ->default(now()->format('Y-m-d'))
                            ->label('Start Date'),

                        Select::make('operation_type')
                            ->options(OperationTypeEnum::class)
                            ->default(OperationTypeEnum::Single)
                            ->native(false)
                            ->live()
                            ->required(),
                        Select::make('customer_count')
                            ->options(fn (Get $get) => $get('operation_type') === OperationTypeEnum::Single ?
                                [
                                    1 => 'One',
                                ] :
                                [
                                    2 => 'Two',
                                    3 => 'Three',
                                ]
                            )
                            ->native(false)
                            ->label('No of Customers')
                            ->live()
                            ->required(),

                        Select::make('status')
                            ->options(StatusEnum::class)
                            ->default(StatusEnum::Active)
                            ->required()
                            ->native(false)
                            ->label('Status'),

                    ])->columns(2),

                Section::make('Non-Individual')
                    ->schema([
                        Checkbox::make('is_non_individual')
                            ->label('Is Non-Individual')
                            ->default(false)
                            ->columnSpan(2)
                            ->live(),
                        TextInput::make('business_gst_no')
                            ->required()
                            ->label('Business GST No')
                            ->regex('/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/')
                            ->visible(fn (Get $get) => $get('is_non_individual')),
                        TextInput::make('business_pan_no')
                            ->required()
                            ->label('Business PAN No')
                            ->regex('/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/')
                            ->visible(fn (Get $get) => $get('is_non_individual')),
                        Textarea::make('business_address')
                            ->required()
                            ->rows(4)
                            ->label('Business Address')
                            ->visible(fn (Get $get) => $get('is_non_individual')),
                        FileUpload::make('board_resolution')
                            ->acceptedFileTypes(['application/pdf'])
                            ->helperText('Only PDF files are allowed')
                            ->disk('documents')
                            ->directory(fn (Get $get) => 'agreements/'.$get('agreement_no'))
                            ->required()
                            ->downloadable()
                            ->openable()
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, Get $get): string {
                                $agreement_no = $get('agreement_no');
                                $file_ext = $file->getClientOriginalExtension();

                                return "board-resolution-{$agreement_no}.{$file_ext}";
                            })
                            ->label('Board Resolution')
                            ->visible(fn (Get $get) => $get('is_non_individual')),
                    ])->columns(2),

                Section::make('Customer Details')
                    ->schema([
                        Select::make('customer_id_1')
                            ->searchable()
                            ->options(fn (Get $get) => self::getAvailableCustomer($get('customer_id_2'), $get('customer_id_3')))
                            ->label('Customer 1')
                            ->reactive()
                            ->required(),

                        Select::make('customer_id_2')
                            ->options(fn (Get $get) => self::getAvailableCustomer($get('customer_id_1'), $get('customer_id_3')))
                            ->hidden(fn (Get $get) => $get('customer_count') < 2 || $get('operation_type') === OperationTypeEnum::Single)
                            ->label('Customer 2')
                            ->searchable()
                            ->reactive()
                            ->required(),

                        Select::make('customer_id_3')
                            ->options(fn (Get $get) => self::getAvailableCustomer($get('customer_id_1'), $get('customer_id_2')))
                            ->hidden(fn (Get $get) => $get('customer_count') < 3 || $get('operation_type') === OperationTypeEnum::Single)
                            ->label('Customer 3')
                            ->searchable()
                            ->reactive()
                            ->required(),
                    ])->columns(2),

                Section::make('Nominee Details')
                    ->schema([
                        TextInput::make('nominee_name')
                            ->label('Nominee Name')
                            ->required(),
                        Select::make('nominee_relationship')
                            ->options(NomineeRelationEnum::class)
                            ->label('Nominee Relationship')
                            ->native(false)
                            ->required(),
                        TextInput::make('nominee_phone_no')
                            ->label('Nominee Phone no')
                            ->numeric()
                            ->required(),
                        TextInput::make('nominee_email')
                            ->email()
                            ->label('Nominee Email')
                            ->required(),
                    ])->columns(2)
                    ->visible(fn (Get $get) => $get('operation_type') === OperationTypeEnum::Single),
            ]);
    }

    /**
     * @return array<int, string>
     */
    public static function getAvailableCustomer(?string $customer_1, ?string $customer_2): array
    {
        $customers = Agreement::customer_search();

        if ($customer_1) {
            unset($customers[$customer_1]);
        }

        if ($customer_2) {
            unset($customers[$customer_2]);
        }

        return $customers;
    }

    public static function table(Table $table): Table
    {
        return $table
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
            TennuresRelationManager::class,
            LockerRelationManager::class,
            // AuditsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgreements::route('/'),
            'create' => Pages\CreateAgreement::route('/create'),
            'view' => Pages\ViewAgreement::route('/{record}'),
            'edit' => Pages\EditAgreement::route('/{record}/edit'),
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

    /**
     * Global search model attributes
     *
     * @return array<int, string>
     */
    public static function getGloballySearchableAttributes(): array
    {
        return ['agreement_no', 'locker.number', 'customer1.customer_name'];
    }

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return implode(' | ', array_filter([$record->agreement_no, $record->locker->number, $record->customer1->customer_name]));
    }

    public static function getGlobalSearchResultUrl(Model $record): ?string
    {
        return AgreementResource::getUrl('view', ['record' => $record]);
    }
}

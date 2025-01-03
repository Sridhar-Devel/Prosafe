<?php

namespace App\Filament\Resources\TennureResource\RelationManagers;

use App\Enums\OperationTypeEnum;
use App\Enums\StatusEnum;
use App\Models\Agreement;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class AgreementRelationManager extends RelationManager
{
    protected static string $relationship = 'agreement';

    public function form(Form $form): Form
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
                                $agreement = $get('agreement_no');
                                $file_ext = $file->getClientOriginalExtension();
                                $date = now()->format('YmdHis');

                                return "{$agreement}-{$date}.{$file_ext}";
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

                        // TODO: reactive() not working
                        Select::make('operation_type')
                            ->options(OperationTypeEnum::class)
                            ->default(OperationTypeEnum::Single)
                            // ->reactive()
                            ->native(false)
                            ->live()
                            ->required(),
                        // TODO: Enum for customer count
                        Select::make('customer_count')
                            ->options([
                                1 => 'One',
                                2 => 'Two',
                                3 => 'Three',
                            ])
                            ->native(false)
                            // ->disabled(fn (Get $get) => $get('operation_type') === OperationTypeEnum::Single)
                            ->default(1)
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('agreement_id')
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

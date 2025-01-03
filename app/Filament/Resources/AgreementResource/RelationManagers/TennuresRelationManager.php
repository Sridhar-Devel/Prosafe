<?php

namespace App\Filament\Resources\AgreementResource\RelationManagers;

use App\Enums\StatusEnum;
use App\Models\Tennure;
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

class TennuresRelationManager extends RelationManager
{
    protected static string $relationship = 'tennures';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Tennure Information')
                    ->schema([
                        Select::make('agreement_id')
                            ->options(Tennure::agreement_search())
                            ->required()
                            ->searchable()
                            ->label('Agreement No'),

                        Select::make('status')
                            ->options(StatusEnum::class)
                            ->default(StatusEnum::Active)
                            ->native(false)
                            ->required(),

                        TextInput::make('invoice_no')
                            ->required()
                            ->live()
                            ->label('Invoice No'),

                        FileUpload::make('payment_receipt')
                            ->acceptedFileTypes(['image/*', 'application/pdf'])
                            ->helperText('Only PDF and Image files are allowed')
                            ->downloadable()
                            ->disk('documents')
                            ->directory(fn (Get $get) => 'tennures/'.$get('invoice_no'))
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, Get $get): string {
                                $invoice = $get('invoice_no');
                                $file_ext = $file->getClientOriginalExtension();
                                $date = now()->format('YmdHis');

                                return "{$invoice}-{$date}.{$file_ext}";
                            })
                            ->label('Payment Receipt'),

                        DatePicker::make('start_date')
                            ->required()
                            ->native(false)
                            ->default(now()->format('Y-m-d'))
                            ->label('Start Date'),

                        Select::make('period')
                            ->options([
                                365 => '1 Year',
                                // 180 => '6 Months',
                            ])
                            ->native(false)
                            ->default(365),
                    ])->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('agreement.agreement_no'),
                TextColumn::make('agreement.locker.number'),
                TextColumn::make('agreement.locker.floor.name'),
                TextColumn::make('agreement.customer1.customer_name'),
                TextColumn::make('agreement.customer2.customer_name'),
                TextColumn::make('agreement.customer3.customer_name'),
                TextColumn::make('invoice_no'),
                TextColumn::make('start_date')->date('Y-m-d'),
                TextColumn::make('end_date')->date('Y-m-d'),
                TextColumn::make('status'),
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

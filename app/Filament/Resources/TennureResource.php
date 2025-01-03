<?php

namespace App\Filament\Resources;

use App\Enums\StatusEnum;
use App\Filament\Resources\TennureResource\Pages;
use App\Filament\Resources\TennureResource\RelationManagers\AgreementRelationManager;
use App\Models\Agreement;
use App\Models\Tennure;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
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

class TennureResource extends Resource
{
    protected static ?string $model = Tennure::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationGroup = 'Documents';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
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
                            ->directory(function (Get $get) {
                                $agreement_no = Agreement::where('id', $get('agreement_id'))->value('agreement_no');

                                return 'agreements/'.$agreement_no.'/invoices';
                            })
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, Get $get): string {
                                $invoice_no = $get('invoice_no');
                                $file_ext = $file->getClientOriginalExtension();

                                return "invoice-{$invoice_no}.{$file_ext}";
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
                            ])
                            ->native(false)
                            ->default(365),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
            AgreementRelationManager::class,
            // AuditsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTennures::route('/'),
            'create' => Pages\CreateTennure::route('/create'),
            'view' => Pages\ViewTennure::route('/{record}'),
            'edit' => Pages\EditTennure::route('/{record}/edit'),
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
        return ['agreement.agreement_no', 'agreement.locker.number', 'agreement.customer1.customer_name', 'invoice_no'];
    }

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return implode(' | ', array_filter([$record->agreement->agreement_no, $record->agreement->locker->number, $record->agreement->customer1->customer_name, $record->invoice_no]));
    }

    public static function getGlobalSearchResultUrl(Model $record): ?string
    {
        return TennureResource::getUrl('view', ['record' => $record]);
    }
}

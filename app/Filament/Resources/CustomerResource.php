<?php

namespace App\Filament\Resources;

use App\Enums\CustomerGenderEnum;
use App\Enums\CustomerTitleEnum;
use App\Enums\GuardianEnum;
use App\Enums\MaritalStatusEnum;
use App\Enums\ProofCategoryEnum;
use App\Enums\StatusEnum;
use App\Filament\Resources\CustomerResource\Pages;
use App\Models\Customer;
use App\Models\ProofType;
use App\Models\State;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
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
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'Customer Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Customer Details')
                    ->schema([
                        Radio::make('customer_title')
                            ->label('Customer Title')
                            ->inline()
                            ->options(CustomerTitleEnum::class)
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('customer_name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),
                        DatePicker::make('dob')
                            ->label('Date of Birth')
                            ->maxDate(now()->format('Y-m-d'))
                            ->native(false)
                            ->required(),
                        Select::make('gender')
                            ->required()
                            ->native(false)
                            ->options(CustomerGenderEnum::class),
                        TextInput::make('occupation')
                            ->label('Occupation')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('nationality')
                            ->label('Nationality')
                            ->default('Indian')
                            ->required()
                            ->maxLength(255),
                        Select::make('marital_status')
                            ->label('Marital Status')
                            ->required()
                            ->native(false)
                            ->options(MaritalStatusEnum::class),
                    ])->columns(2),
                Section::make('Customer photo/signature')
                    ->schema([
                        FileUpload::make('customer_photo')
                            ->acceptedFileTypes(['image/jpg', 'image/jpeg'])
                            ->disk('documents')
                            ->maxSize(2048)
                            ->directory(function (Get $get) {
                                $email = $get('email');

                                return 'customers/'.$email;
                            })
                            ->downloadable()
                            ->label('Upload Customer Photo')
                            ->helperText('Only JPG/JPEG files are allowed.')
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, Get $get): string {
                                $customer_name = $get('customer_name');
                                $date = now()->format('d-m-Y');
                                $filename = Str::slug("{$customer_name}-photo-{$date}", '-');

                                $file_ext = $file->getClientOriginalExtension();

                                return "{$filename}.{$file_ext}";
                            })
                            ->required(),
                        FileUpload::make('customer_sign')
                            ->acceptedFileTypes(['image/png', 'image/jpeg'])
                            ->disk('documents')
                            ->directory(function (Get $get) {
                                $email = $get('email');

                                return 'customers/'.$email;
                            })
                            ->downloadable()
                            ->maxSize(2048)
                            ->helperText('Only JPEG/PNG files are allowed.')
                            ->label('Upload Customer Signature')
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, Get $get): string {
                                $customer_name = $get('customer_name');
                                $date = now()->format('d-m-Y');
                                $filename = Str::slug("{$customer_name}-signature-{$date}", '-');

                                $file_ext = $file->getClientOriginalExtension();

                                return "{$filename}.{$file_ext}";
                            })
                            ->required(),
                    ])->columns(2),
                Section::make('Guardian Details')
                    ->schema([
                        Radio::make('guardian_title')
                            ->label('Guardian Title')
                            ->options(CustomerTitleEnum::class)
                            ->inline()
                            ->columnSpan(2),
                        Select::make('guardian')
                            ->native(false)
                            ->label('Select Guardian')
                            ->options(GuardianEnum::class),
                        TextInput::make('guardian_name')
                            ->label('Guardian Name')
                            ->maxLength(255),
                    ])->columns(2),
                Section::make('Telephone')
                    ->schema([
                        TextInput::make('phone')
                            ->label('Mobile')
                            ->placeholder('9876543210')
                            ->tel()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(13),
                        TextInput::make('phone2')
                            ->label('Mobile (Whatsapp)')
                            ->placeholder('9876543210')
                            ->tel()
                            ->unique(ignoreRecord: true)
                            ->maxLength(13),
                        TextInput::make('residence_landline')
                            ->tel()
                            ->maxLength(14),
                    ])->columns(2),
                Section::make('Email')
                    ->schema([
                        TextInput::make('email')
                            ->email()
                            ->label('Email ID')
                            ->required()
                            ->live()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                    ])->columns(2),
                Section::make('Permanent Address')
                    ->schema([
                        TextInput::make('pa_door_no')
                            ->label('Door/Apartment No')
                            ->required()
                            ->maxLength(6),
                        TextInput::make('pa_apartment_name')
                            ->label('Apartment / Building Name')
                            ->maxLength(255),
                        TextInput::make('pa_street_name')
                            ->label('Street Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('pa_pincode')
                            ->required()
                            ->label('Pincode')
                            ->numeric()
                            ->maxLength(6),
                        TextInput::make('pa_city')
                            ->required()
                            ->label('City')
                            ->maxLength(255),
                        Select::make('pa_state_id')
                            ->label('State')
                            ->required()
                            ->native(false)
                            ->options(function () {
                                return State::pluck('name', 'id');
                            })
                            ->searchable(),
                    ])->columns(2),

                Section::make('')
                    ->schema([
                        Radio::make('same_address')
                            ->label('Is Contact Address same as Permanent Address?')
                            ->inline()
                            ->options([
                                'Yes' => 'Yes',
                                'No' => 'No',
                            ])
                            ->default('Yes')
                            ->required()
                            ->live(),
                    ])->columns(2),
                Section::make('Contact Address')
                    ->schema([
                        TextInput::make('ca_door_no')
                            ->label('Door/Apartment No')
                            ->required()
                            ->hidden(fn (Get $get) => $get('same_address') === 'Yes')
                            ->maxLength(6),
                        TextInput::make('ca_apartment_name')
                            ->label('Apartment / Building Name')
                            ->hidden(fn (Get $get) => $get('same_address') === 'Yes')
                            ->maxLength(255),
                        TextInput::make('ca_street_name')
                            ->label('Street Name')
                            ->required()
                            ->hidden(fn (Get $get) => $get('same_address') === 'Yes')
                            ->maxLength(255),
                        TextInput::make('ca_pincode')
                            ->required()
                            ->label('Pincode')
                            ->numeric()
                            ->hidden(fn (Get $get) => $get('same_address') === 'Yes')
                            ->maxLength(6),
                        TextInput::make('ca_city')
                            ->required()
                            ->label('City')
                            ->hidden(fn (Get $get) => $get('same_address') === 'Yes')
                            ->maxLength(255),

                        Select::make('ca_state_id')
                            ->label('State')
                            ->native(false)
                            ->options(function () {
                                return State::pluck('name', 'id');
                            })
                            ->searchable(),
                    ])
                    ->columns(2)
                    ->hidden(fn (Get $get) => $get('same_address') === 'Yes'),
                Section::make('PAN Details')
                    ->schema([
                        TextInput::make('pan_card_no')
                            ->label('PAN No')
                            ->regex('/^[A-Z]{5}\d{4}[A-Z]{1}$/') // (e.g.) DMAPG6543Y
                            ->required()
                            ->maxLength(10),
                    ])
                    ->columns(2),
                Section::make('Proof of Identity')
                    ->schema([
                        Select::make('identity_proof_id')
                            ->label('Identity Proof')
                            ->native(false)
                            ->options(ProofType::where('status', '=', StatusEnum::Active)->whereIn('category', [ProofCategoryEnum::IdentityProof, ProofCategoryEnum::IdentityAddressProof])->pluck('name', 'id')->toArray())
                            ->required()
                            ->live(),
                        TextInput::make('identity_proof_no')
                            ->maxLength(15)
                            ->label('Identity Proof No')
                            ->required(),
                        FileUpload::make('proof_of_identity')
                            ->acceptedFileTypes(['image/jpg', 'image/jpeg', 'application/pdf'])
                            ->helperText('Only JPG/JPEG/PDF files are allowed.')
                            ->disk('documents')
                            ->maxSize(2048)
                            ->directory(function (Get $get) {
                                $email = $get('email');

                                return 'customers/'.$email;
                            })
                            ->downloadable()
                            ->label('Upload Document')
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, Get $get): string {
                                $customer_name = $get('customer_name');
                                $date = now()->format('d-m-Y');
                                $proof_type = ProofType::where('id', $get('identity_proof_id'))->value('slug');
                                $filename = Str::slug("{$customer_name}-{$proof_type}-{$date}", '-');

                                $file_ext = $file->getClientOriginalExtension();

                                return "{$filename}.{$file_ext}";
                            })
                            ->required(),
                    ])->columns(2),
                Section::make('Proof of Address')
                    ->schema([
                        Select::make('address_proof_id')
                            ->label('Address Proof')
                            ->native(false)
                            ->live()
                            ->options(fn (Get $get) => self::getAddressProof($get('identity_proof_id')))
                            ->required(),
                        TextInput::make('address_proof_no')
                            ->maxLength(15)
                            ->label('Address Proof No')
                            ->required(),
                        FileUpload::make('proof_of_address')
                            ->acceptedFileTypes(['image/jpg', 'image/jpeg', 'application/pdf'])
                            ->helperText('Only JPG/JPEG/PDF files are allowed.')
                            ->disk('documents')
                            ->maxSize(2048)
                            ->directory(function (Get $get) {
                                $email = $get('email');

                                return 'customers/'.$email;
                            })
                            ->downloadable()
                            ->label('Upload Document')
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, Get $get): string {
                                $customer_name = $get('customer_name');
                                $date = now()->format('d-m-Y');
                                $proof_type = ProofType::where('id', $get('address_proof_id'))->value('slug');
                                $filename = Str::slug("{$customer_name}-{$proof_type}-{$date}", '-');

                                $file_ext = $file->getClientOriginalExtension();

                                return "{$filename}.{$file_ext}";
                            })
                            ->required(),
                    ])->columns(2),
            ]);
    }

    /**
     * @return array<int, mixed>
     */
    public static function getFormSchema(?string $section): array
    {
        if ($section === 'Personal Details') {
            return [
                Section::make('Customer Details')
                    ->schema([
                        Radio::make('customer_title')
                            ->label('Customer Title')
                            ->inline()
                            ->options(CustomerTitleEnum::class)
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('customer_name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),
                        DatePicker::make('dob')
                            ->native(false)
                            ->label('Date of Birth')
                            ->maxDate(now()->format('Y-m-d'))
                            ->required(),
                        Select::make('gender')
                            ->native(false)
                            ->required()
                            ->options(CustomerGenderEnum::class),
                        TextInput::make('occupation')
                            ->label('Occupation')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('nationality')
                            ->label('Nationality')
                            ->default('Indian')
                            ->required()
                            ->maxLength(255),
                        Select::make('marital_status')
                            ->label('Marital Status')
                            ->native(false)
                            ->required()
                            ->options(MaritalStatusEnum::class),
                    ])->columns(2),
                Section::make('Customer photo/signature')
                    ->schema([
                        FileUpload::make('customer_photo')
                            ->acceptedFileTypes(['image/jpg', 'image/jpeg'])
                            ->disk('documents')
                            ->maxSize(2048)
                            ->directory(function (Get $get) {
                                $email = $get('email');

                                return 'customers/'.$email;
                            })
                            ->downloadable()
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, Get $get): string {
                                $customer_name = $get('customer_name');
                                $date = now()->format('d-m-Y');
                                $filename = Str::slug("{$customer_name}-photo-{$date}", '-');

                                $file_ext = $file->getClientOriginalExtension();

                                return "{$filename}.{$file_ext}";
                            })
                            ->label('Upload Customer Photo')
                            ->helperText('Only JPG/JPEG files are allowed.')
                            ->required(),
                        FileUpload::make('customer_sign')
                            ->acceptedFileTypes(['image/png', 'image/jpeg'])
                            ->disk('documents')
                            ->directory(function (Get $get) {
                                $email = $get('email');

                                return 'customers/'.$email;
                            })
                            ->downloadable()
                            ->maxSize(2048)
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, Get $get): string {
                                $customer_name = $get('customer_name');
                                $date = now()->format('d-m-Y');
                                $filename = Str::slug("{$customer_name}-signature-{$date}", '-');

                                $file_ext = $file->getClientOriginalExtension();

                                return "{$filename}.{$file_ext}";
                            })
                            ->helperText('Only JPEG/PNG files are allowed.')
                            ->label('Upload Customer Signature')
                            ->required(),
                    ])->columns(2),
                Section::make('Guardian Details')
                    ->schema([
                        Radio::make('guardian_title')
                            ->label('Guardian Title')
                            ->options(CustomerTitleEnum::class)
                            ->inline()
                            ->columnSpan(2),
                        Select::make('guardian')
                            ->native(false)
                            ->label('Select Guardian')
                            ->options(GuardianEnum::class),
                        TextInput::make('guardian_name')
                            ->label('Guardian Name')
                            ->maxLength(255),
                    ])->columns(2),
            ];
        }

        if ($section === 'Contact Details') {
            return [
                Section::make('Telephone')
                    ->schema([
                        TextInput::make('phone')
                            ->label('Mobile')
                            ->placeholder('9876543210')
                            ->tel()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(13),
                        TextInput::make('phone2')
                            ->label('Mobile (Whatsapp)')
                            ->placeholder('9876543210')
                            ->tel()
                            ->unique(ignoreRecord: true)
                            ->maxLength(13),
                        TextInput::make('residence_landline')
                            ->tel()
                            ->maxLength(14),
                    ])->columns(2),
                Section::make('Email')
                    ->schema([
                        TextInput::make('email')
                            ->email()
                            ->label('Email ID')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                    ])->columns(2),
            ];
        }

        if ($section === 'Permanent / Contact Address') {
            return [
                Section::make('Permanent Address')
                    ->schema([
                        TextInput::make('pa_door_no')
                            ->label('Door/Apartment No')
                            ->required()
                            ->maxLength(6),
                        TextInput::make('pa_apartment_name')
                            ->label('Apartment / Building Name')
                            ->maxLength(255),
                        TextInput::make('pa_street_name')
                            ->label('Street Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('pa_pincode')
                            ->required()
                            ->label('Pincode')
                            ->numeric()
                            ->maxLength(6),
                        TextInput::make('pa_city')
                            ->required()
                            ->label('City')
                            ->maxLength(255),
                        Select::make('pa_state_id')
                            ->label('State')
                            ->native(false)
                            ->default(State::where('code', 'TN')->value('id'))
                            ->searchable()
                            ->options(function () {
                                return State::pluck('name', 'id');
                            }),
                    ])->columns(2),

                Section::make('')
                    ->schema([
                        Radio::make('same_address')
                            ->label('Is Contact Address same as Permanent Address?')
                            ->inline()
                            ->options([
                                'Yes' => 'Yes',
                                'No' => 'No',
                            ])
                            ->default('Yes')
                            ->required()
                            ->live(),
                    ])->columns(2),
                Section::make('Contact Address')
                    ->schema([
                        TextInput::make('ca_door_no')
                            ->label('Door/Apartment No')
                            ->required()
                            ->hidden(fn (Get $get) => $get('same_address') === 'Yes')
                            ->maxLength(6),
                        TextInput::make('ca_apartment_name')
                            ->label('Apartment / Building Name')
                            ->hidden(fn (Get $get) => $get('same_address') === 'Yes')
                            ->maxLength(255),
                        TextInput::make('ca_street_name')
                            ->label('Street Name')
                            ->required()
                            ->hidden(fn (Get $get) => $get('same_address') === 'Yes')
                            ->maxLength(255),
                        TextInput::make('ca_pincode')
                            ->required()
                            ->label('Pincode')
                            ->numeric()
                            ->hidden(fn (Get $get) => $get('same_address') === 'Yes')
                            ->maxLength(6),
                        TextInput::make('ca_city')
                            ->required()
                            ->label('City')
                            ->hidden(fn (Get $get) => $get('same_address') === 'Yes')
                            ->maxLength(255),
                        Select::make('ca_state_id')
                            ->label('State')
                            ->native(false)
                            ->default(State::where('code', 'TN')->value('id'))
                            ->searchable()
                            ->options(function () {
                                return State::pluck('name', 'id');
                            }),
                    ])
                    ->columns(2)
                    ->hidden(fn (Get $get) => $get('same_address') === 'Yes'),
            ];
        }
        if ($section === 'KYC Details') {
            return [
                Section::make('PAN Details')
                    ->schema([
                        TextInput::make('pan_card_no')
                            ->label('PAN No')
                            ->regex('/^[A-Z]{5}\d{4}[A-Z]{1}$/')
                            ->required()
                            ->maxLength(10),
                    ])
                    ->columns(2),
                Section::make('Proof of Identity')
                    ->schema([
                        Select::make('identity_proof_id')
                            ->label('Identity Proof')
                            ->native(false)
                            ->options(ProofType::where('status', '=', StatusEnum::Active)->whereIn('category', [ProofCategoryEnum::IdentityProof, ProofCategoryEnum::IdentityAddressProof])->pluck('name', 'id')->toArray())
                            ->required()
                            ->live(),
                        TextInput::make('identity_proof_no')
                            ->maxLength(15)
                            ->label('Identity Proof No')
                            ->required(),
                        FileUpload::make('proof_of_identity')
                            ->acceptedFileTypes(['image/jpg', 'image/jpeg', 'application/pdf'])
                            ->helperText('Only JPG/JPEG/PDF files are allowed.')
                            ->disk('documents')
                            ->maxSize(2048)
                            ->directory(function (Get $get) {
                                $email = $get('email');

                                return 'customers/'.$email;
                            })
                            ->downloadable()
                            ->label('Upload Document')
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, Get $get): string {
                                $customer_name = $get('customer_name');
                                $date = now()->format('d-m-Y');
                                $proof_type = ProofType::where('id', $get('identity_proof_id'))->value('slug');
                                $filename = Str::slug("{$customer_name}-{$proof_type}-{$date}", '-');

                                $file_ext = $file->getClientOriginalExtension();

                                return "{$filename}.{$file_ext}";
                            })
                            ->required(),
                    ])->columns(2),
                Section::make('Proof of Address')
                    ->schema([
                        Select::make('address_proof_id')
                            ->label('Address Proof')
                            ->options(fn (Get $get) => self::getAddressProof($get('identity_proof_id')))
                            ->live()
                            ->native(false)
                            ->required(),
                        TextInput::make('address_proof_no')
                            ->maxLength(15)
                            ->label('Address Proof No')
                            ->required(),
                        FileUpload::make('proof_of_address')
                            ->acceptedFileTypes(['image/jpg', 'image/jpeg', 'application/pdf'])
                            ->helperText('Only JPG/JPEG/PDF files are allowed.')
                            ->disk('documents')
                            ->maxSize(2048)
                            ->directory(function (Get $get) {
                                $email = $get('email');

                                return 'customers/'.$email;
                            })
                            ->downloadable()
                            ->label('Upload Document')
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, Get $get): string {
                                $customer_name = $get('customer_name');
                                $date = now()->format('d-m-Y');
                                $proof_type = ProofType::where('id', $get('address_proof_id'))->value('slug');
                                $filename = Str::slug("{$customer_name}-{$proof_type}-{$date}", '-');

                                $file_ext = $file->getClientOriginalExtension();

                                return "{$filename}.{$file_ext}";
                            })
                            ->required(),
                    ])->columns(2),
            ];
        }

        return [];
    }

    /**
     * @return array<int, string>
     */
    protected static function getAddressProof(?string $identityProofId): array
    {
        return ProofType::where('status', StatusEnum::Active)
            ->whereIn('category', [ProofCategoryEnum::AddressProof, ProofCategoryEnum::IdentityAddressProof])
            ->where('id', '!=', $identityProofId)
            ->pluck('name', 'id')
            ->toArray();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('gender'),
                TextColumn::make('dob')
                    ->date('d-m-Y')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('pa_city')
                    ->label('District')
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
            // AuditsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'view' => Pages\ViewCustomer::route('/{record}'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
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
        return ['customer_name', 'email', 'phone', 'phone2'];
    }

    /**
     * Summary of getGlobalSearchResultTitle
     */
    public static function getGlobalSearchResultTitle(Model $record): string
    {

        return implode(' | ', array_filter([$record->customer_name, $record->email, $record->phone, $record->phone2]));
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return CustomerResource::getUrl('view', ['record' => $record]);
    }
}

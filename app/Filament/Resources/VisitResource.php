<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Enums\StatusEnum;
use App\Filament\Resources\VisitResource\Pages;
use App\Models\Agreement;
use App\Models\Customer;
use App\Models\Locker;
use App\Models\User;
use App\Models\Visit;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class VisitResource extends Resource
{
    protected static ?string $model = Visit::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-left-on-rectangle';

    protected static ?string $navigationLabel = 'Visit Entry';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Locker')
                    ->schema([
                        Select::make('locker_id')
                            ->label('Locker')
                            ->options(Visit::locker_search())
                            ->searchable()
                            ->live()
                            ->required(),
                    ])->columns(2),

                Section::make('Customer 1')
                    ->schema([
                        Select::make('customer_id')
                            ->label('Customer 1')
                            ->options(fn (Get $get) => self::getlockerCustomer($get('locker_id'), null, null))
                            ->required()
                            ->native(false)
                            ->live(),

                        FileUpload::make('customer1_photo')
                            ->acceptedFileTypes(['image/jpg', 'image/jpeg'])
                            ->disk('documents')
                            ->maxSize(2048)
                            ->directory(function (Get $get) {
                                $email = Customer::where('id', $get('customer_id'))->value('email');
                                $locker_no = Locker::where('id', $get('locker_id'))->value('number');
                                $floor_id = Locker::where('id', $get('locker_id'))->value('floor_id');

                                return 'visits/'.$email.'/'.$floor_id.'-'.$locker_no;
                            })
                            ->downloadable()
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, Get $get): string {
                                $email = Customer::where('id', $get('customer_id'))->value('email');
                                $locker_no = Locker::where('id', $get('locker_id'))->value('number');
                                $file_ext = $file->getClientOriginalExtension();
                                $date = now()->format('YmdHis');

                                return "{$email}-{$locker_no}-{$date}.{$file_ext}";
                            })
                            ->label('Upload Customer 1 Photo')
                            ->helperText('Only JPG/JPEG files are allowed.')
                            ->required(),

                    ])->columns(2),

                Section::make('Customer 2')
                    ->schema([
                        Select::make('customer2_id')
                            ->label('Customer 2')
                            ->live()
                            ->native(false)
                            ->options(fn (Get $get) => self::getlockerCustomer($get('locker_id'), $get('customer_id'), null))
                            ->required(fn (Get $get) => Agreement::where('locker_id', $get('locker_id'))
                                ->where('status', StatusEnum::Active)
                                ->value('operation_type') === 'Joint'),
                        FileUpload::make('customer2_photo')
                            ->acceptedFileTypes(['image/jpg', 'image/jpeg'])
                            ->disk('documents')
                            ->maxSize(2048)
                            ->directory(function (Get $get) {
                                $email = Customer::where('id', $get('customer_id'))->value('email');
                                $locker_no = Locker::where('id', $get('locker_id'))->value('number');
                                $floor_id = Locker::where('id', $get('locker_id'))->value('floor_id');

                                return 'visits/'.$email.'/'.$floor_id.'-'.$locker_no;
                            })
                            ->downloadable()
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, Get $get): string {
                                $email = Customer::where('id', $get('customer_id'))->value('email');
                                $locker_no = Locker::where('id', $get('locker_id'))->value('number');
                                $file_ext = $file->getClientOriginalExtension();
                                $date = now()->format('YmdHis');

                                return "{$email}-{$locker_no}-{$date}.{$file_ext}";
                            })
                            ->label('Upload Customer 2 Photo')
                            ->helperText('Only JPG files are allowed.')
                            ->required(fn (Get $get) => Agreement::where('locker_id', $get('locker_id'))
                                ->where('status', StatusEnum::Active)
                                ->value('operation_type') === 'Joint'),
                    ])->columns(2)
                    ->hidden(fn (Get $get) => self::getCustomerCount($get('locker_id')) < 2),

                Section::make('Customer 3')
                    ->schema([
                        Select::make('customer3_id')
                            ->label('Customer 3')
                            ->live()
                            ->native(false)
                            ->options(fn (Get $get) => self::getlockerCustomer($get('locker_id'), $get('customer_id'), $get('customer2_id')))
                            ->required(fn (Get $get) => Agreement::where('locker_id', $get('locker_id'))
                                ->where('status', StatusEnum::Active)
                                ->value('operation_type') === 'Joint'),

                        FileUpload::make('customer3_photo')
                            ->acceptedFileTypes(['image/jpg', 'image/jpeg'])
                            ->disk('documents')
                            ->maxSize(2048)
                            ->directory(function (Get $get) {
                                $email = Customer::where('id', $get('customer_id'))->value('email');
                                $locker_no = Locker::where('id', $get('locker_id'))->value('number');
                                $floor_id = Locker::where('id', $get('locker_id'))->value('floor_id');

                                return 'visits/'.$email.'/'.$floor_id.'-'.$locker_no;
                            })
                            ->downloadable()
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, Get $get): string {
                                $email = Customer::where('id', $get('customer_id'))->value('email');
                                $locker_no = Locker::where('id', $get('locker_id'))->value('number');
                                $file_ext = $file->getClientOriginalExtension();
                                $date = now()->format('YmdHis');

                                return "{$email}-{$locker_no}-{$date}.{$file_ext}";
                            })
                            ->label('Upload Customer 3 Photo')
                            ->helperText('Only JPG files are allowed.')
                            ->required(fn (Get $get) => Agreement::where('locker_id', $get('locker_id'))
                                ->where('status', StatusEnum::Active)
                                ->value('operation_type') === 'Joint'),
                    ])->columns(2)
                    ->hidden(fn (Get $get) => self::getCustomerCount($get('locker_id')) < 3),

                Section::make('Time In/Out')
                    ->schema([
                        DateTimePicker::make('time_in')
                            ->label('In Time')
                            ->disabled()
                            ->default(now()->format('Y-m-d H:i:s'))
                            ->live()
                            ->required(),

                        DateTimePicker::make('time_out')
                            ->label('Out Time')
                            ->hidden(fn (Get $get) => $get('id') === null)
                            ->after('time_in')
                            ->before(fn (Get $get) => Carbon::parse($get('time_in'))->addMinutes(15)->format('Y-m-d H:i:s'))
                            ->required(),
                    ])->columns(2),

                Select::make('user_id')
                    ->label('User')
                    ->native(false)
                    // ->disabled()
                    ->default(User::where('email', optional(auth()->user())->email)->value('id'))
                    ->options(User::where('email', optional(auth()->user())->email)->pluck('name', 'id')->toArray())
                    ->required(),
            ]);
    }

    protected static function getCustomerCount(?string $locker_id): int
    {
        if ($locker_id == null) {
            return 0;
        }

        return intval(Agreement::where('locker_id', $locker_id)
            ->where('status', StatusEnum::Active)
            ->value('customer_count'));
    }

    /**
     * @return array<int, string>
     */
    protected static function getlockerCustomer(?string $locker_id, ?int $customer_member_1, ?int $customer_member_2): array
    {
        if ($locker_id == null) {
            return [];
        }

        $customer_count = self::getCustomerCount($locker_id);

        $customers = [];

        for ($i = 1; $i <= $customer_count; $i++) {
            $customer_id = (int) Agreement::where('locker_id', $locker_id)
                ->where('status', StatusEnum::Active)
                ->value('customer_id_'.$i);

            $customer = Customer::where('id', $customer_id)->first();

            $customers[$customer_id] = $customer->customer_title->name.'.'.$customer->customer_name.' | '.$customer->email.' | '.$customer->phone;
        }

        if ($customer_member_1) {
            unset($customers[$customer_member_1]);
        }

        if ($customer_member_2) {
            unset($customers[$customer_member_2]);
        }

        return $customers;
    }

    public static function table(Table $table): Table
    {
        return $table
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
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        DatePicker::make('start_date')
                            ->native(false),
                        DatePicker::make('end_date')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['start_date'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['end_date'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
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
                    FilamentExportBulkAction::make('export'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVisits::route('/'),
            'create' => Pages\CreateVisit::route('/create'),
            'view' => Pages\ViewVisit::route('/{record}'),
            'edit' => Pages\EditVisit::route('/{record}/edit'),
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
        return ['customer.customer_name', 'locker.number', 'user.name'];
    }

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return implode(' | ', array_filter([$record->customer->customer_name, $record->locker->number, $record->user->name]));
    }

    public static function getGlobalSearchResultUrl(Model $record): ?string
    {
        return TennureResource::getUrl('view', ['record' => $record]);
    }
}

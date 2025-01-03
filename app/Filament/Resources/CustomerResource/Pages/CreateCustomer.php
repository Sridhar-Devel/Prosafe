<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;
use Illuminate\Database\Eloquent\Model;

class CreateCustomer extends CreateRecord
{
    use HasWizard;

    protected static string $resource = CustomerResource::class;

    /**
     * @return array<int, Step>
     */
    protected function getSteps(): array
    {
        return [
            Step::make('Personal Details')
                ->schema([
                    Group::make(CustomerResource::getFormSchema('Personal Details'))->columns(),
                ]),
            Step::make('Contact Details')
                ->schema([
                    Group::make(CustomerResource::getFormSchema('Contact Details'))->columns(),
                ]),
            Step::make('Permanent / Contact Address')
                ->schema([
                    Group::make(CustomerResource::getFormSchema('Permanent / Contact Address'))->columns(),
                ]),
            Step::make('KYC Details')
                ->schema([
                    Group::make(CustomerResource::getFormSchema('KYC Details'))->columns(),
                ]),
        ];
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function handleRecordCreation(array $data): Model
    {
        if ($data['same_address'] === 'Yes') {
            $data['ca_door_no'] = $data['pa_door_no'];
            $data['ca_apartment_name'] = $data['pa_apartment_name'];
            $data['ca_street_name'] = $data['pa_street_name'];
            $data['ca_city'] = $data['pa_city'];
            $data['ca_state_id'] = $data['pa_state_id'];
            $data['ca_pincode'] = $data['pa_pincode'];
        }

        return static::getModel()::create($data);
    }
}

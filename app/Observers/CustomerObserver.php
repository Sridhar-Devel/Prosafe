<?php

namespace App\Observers;

use App\Enums\StatusEnum;
use App\Mail\Customer as MailCustomer;
use App\Models\Customer;
use App\Models\Document;
use App\Models\ProofType;
use Illuminate\Support\Facades\Storage;
use Mail;

class CustomerObserver
{
    /**
     * Handle the Customer "created" event.
     */
    public function created(Customer $customer): void
    {
        $this->processCustomerDocument(
            $customer,
            'Identity Proof',
            ProofType::where('id', $customer->identity_proof_id)->value('name'),
            $customer->proof_of_identity
        );

        $this->processCustomerDocument(
            $customer,
            'Address Proof',
            ProofType::where('id', $customer->address_proof_id)->value('name'),
            $customer->proof_of_address
        );

        // Sending email to customer
        // Mail::to($customer->email)
        //     ->send(new MailCustomer($customer));
    }

    /**
     * Handle the Customer "updated" event.
     */
    public function updated(Customer $customer): void
    {
        $this->processCustomerDocument(
            $customer,
            'Identity Proof',
            ProofType::where('id', $customer->identity_proof_id)->value('name'),
            $customer->proof_of_identity
        );

        $this->processCustomerDocument(
            $customer,
            'Address Proof',
            ProofType::where('id', $customer->address_proof_id)->value('name'),
            $customer->proof_of_address
        );

    }

    /**
     * Update customer documents into Documents.
     */
    protected function processCustomerDocument(Customer $customer, string $document_type, string $document_name, string $documentPath): void
    {

        $existingDocument = Document::where('customer_id', $customer->id)
            ->where('document_type', $document_type)
            ->where('status', StatusEnum::Active)
            ->first();

        if (! $existingDocument) {
            Document::create([
                'customer_id' => $customer->id,
                'document_type' => $document_type,
                'document_name' => $document_name,
                'document_path' => $documentPath,
                'status' => StatusEnum::Active,
            ]);
        } elseif ($existingDocument->document_path !== $documentPath) {
            $existingDocument->update([
                'document_type' => $document_type,
                'status' => StatusEnum::Inactive,
            ]);
            Document::create([
                'customer_id' => $customer->id,
                'document_type' => $document_type,
                'document_name' => $document_name,
                'document_path' => $documentPath,
                'status' => StatusEnum::Active,
            ]);
        }
    }

    /**
     * Handle the Customer "deleted" event.
     */
    public function deleted(Customer $customer): void
    {
        //
    }

    /**
     * Handle the Customer "restored" event.
     */
    public function restored(Customer $customer): void
    {
        //
    }

    /**
     * Handle the Customer "force deleted" event.
     */
    public function forceDeleted(Customer $customer): void
    {
        Storage::delete([
            'documents/'.$customer->customer_photo,
            'documents/'.$customer->customer_sign,
            'documents/'.$customer->proof_of_address,
            'documents/'.$customer->proof_of_identity,
        ]);
    }
}

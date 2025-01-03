<?php

namespace Database\Seeders;

use App\Enums\ProofCategoryEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProofTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proofs = [
            [
                'name' => 'Voter ID',
                'slug' => 'voter-id',
                'category' => ProofCategoryEnum::IdentityAddressProof,
                'status' => StatusEnum::Active,
            ],
            [
                'name' => 'Driving License',
                'slug' => 'driving-license',
                'category' => ProofCategoryEnum::IdentityAddressProof,
                'status' => StatusEnum::Active,
            ],
            [
                'name' => 'Aadhar Card',
                'slug' => 'aadhar-card',
                'category' => ProofCategoryEnum::IdentityAddressProof,
                'status' => StatusEnum::Active,
            ],
            [
                'name' => 'Ration Card (with photo)',
                'slug' => 'ration-card',
                'category' => ProofCategoryEnum::IdentityAddressProof,
                'status' => StatusEnum::Active,
            ],
            [
                'name' => 'Electricity Bill with book copy (not more than 3 months old)',
                'slug' => 'electricity-bill',
                'category' => ProofCategoryEnum::AddressProof,
                'status' => StatusEnum::Active,
            ],
            [
                'name' => 'Telephone Bill (landline)',
                'slug' => 'telephone-bill',
                'category' => ProofCategoryEnum::AddressProof,
                'status' => StatusEnum::Active,
            ],
            [
                'name' => 'Bank account statement (with 3 months transaction authenticated by bank)',
                'slug' => 'bank-account-statement',
                'category' => ProofCategoryEnum::AddressProof,
                'status' => StatusEnum::Active,
            ],
            [
                'name' => 'Bank Passbook (with authentication)',
                'slug' => 'bank-passbook',
                'category' => ProofCategoryEnum::AddressProof,
                'status' => StatusEnum::Active,
            ],
            [
                'name' => 'Registered Lease Agreement',
                'slug' => 'lease-agreement',
                'category' => ProofCategoryEnum::AddressProof,
                'status' => StatusEnum::Active,
            ],
            [
                'name' => 'Property tax receipt with book copy',
                'slug' => 'tax-receipt',
                'category' => ProofCategoryEnum::AddressProof,
                'status' => StatusEnum::Active,
            ],
            [
                'name' => 'Passport',
                'slug' => 'passport',
                'category' => ProofCategoryEnum::IdentityProof,
                'status' => StatusEnum::Active,
            ],
        ];

        foreach ($proofs as $proof) {
            DB::table('proof_types')->insert([
                'name' => $proof['name'],
                'slug' => $proof['slug'],
                'category' => $proof['category'],
                'status' => $proof['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

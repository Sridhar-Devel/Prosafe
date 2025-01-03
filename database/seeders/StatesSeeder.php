<?php

namespace Database\Seeders;

use App\Enums\StatusEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['Andhra Pradesh', 'AP', StatusEnum::Active],
            ['Arunachal Pradesh', 'AR', StatusEnum::Active],
            ['Assam', 'AS', StatusEnum::Active],
            ['Bihar', 'BR', StatusEnum::Active],
            ['Chhattisgarh', 'CG', StatusEnum::Active],
            ['Goa', 'GA', StatusEnum::Active],
            ['Gujarat', 'GJ', StatusEnum::Active],
            ['Haryana', 'HR', StatusEnum::Active],
            ['Himachal Pradesh', 'HP', StatusEnum::Active],
            ['Jharkhand', 'JH', StatusEnum::Active],
            ['Karnataka', 'KA', StatusEnum::Active],
            ['Kerala', 'KL', StatusEnum::Active],
            ['Madhya Pradesh', 'MP', StatusEnum::Active],
            ['Maharashtra', 'MH', StatusEnum::Active],
            ['Manipur', 'MN', StatusEnum::Active],
            ['Meghalaya', 'ML', StatusEnum::Active],
            ['Mizoram', 'MZ', StatusEnum::Active],
            ['Nagaland', 'NL', StatusEnum::Active],
            ['Odisha', 'OR', StatusEnum::Active],
            ['Punjab', 'PB', StatusEnum::Active],
            ['Rajasthan', 'RJ', StatusEnum::Active],
            ['Sikkim', 'SK', StatusEnum::Active],
            ['Tamil Nadu', 'TN', StatusEnum::Active],
            ['Telangana', 'TG', StatusEnum::Active],
            ['Tripura', 'TR', StatusEnum::Active],
            ['Uttar Pradesh', 'UP', StatusEnum::Active],
            ['Uttarakhand', 'UK', StatusEnum::Active],
            ['West Bengal', 'WB', StatusEnum::Active],
            ['Andaman and Nicobar Islands', 'AN', StatusEnum::Active],
            ['Chandigarh', 'CH', StatusEnum::Active],
            ['Dadra and Nagar Haveli and Daman and Diu', 'DN', StatusEnum::Active],
            ['Delhi', 'DL', StatusEnum::Active],
            ['Lakshadweep', 'LD', StatusEnum::Active],
            ['Puducherry', 'PY', StatusEnum::Active],
        ];

        foreach ($states as $state) {
            DB::table('states')->insert([
                'name' => $state[0],
                'code' => $state[1],
                'status' => $state[2],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

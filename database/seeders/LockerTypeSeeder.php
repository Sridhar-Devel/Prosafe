<?php

namespace Database\Seeders;

use App\Enums\StatusEnum;
use App\Models\LockerType;
use Illuminate\Database\Seeder;

class LockerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locker_types = [
            [
                'name' => 'Small',
                'description' => 'A small 8x8 locker',
                'status' => StatusEnum::Active,
            ],
            [
                'name' => 'Medium',
                'description' => 'Medium 12x12 locker',
                'status' => StatusEnum::Active,
            ],
            [
                'name' => 'Large',
                'description' => 'Large 16x16 locker',
                'status' => StatusEnum::Active,
            ],
        ];

        foreach ($locker_types as $locker_type) {
            LockerType::create($locker_type);
        }
    }
}

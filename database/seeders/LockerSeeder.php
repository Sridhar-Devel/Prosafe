<?php

namespace Database\Seeders;

use App\Models\Floor;
use App\Models\Locker;
use App\Models\LockerType;
use Illuminate\Database\Seeder;

class LockerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Locker::truncate();

        $csvFile = fopen(base_path('database/data/locker.csv'), 'r');

        $firstLine = true;

        while (($data = fgetcsv($csvFile, 1000, ',')) !== false) {
            $floor_id = Floor::where('name', $data[2])->value('id');
            $locker_type_id = LockerType::where('name', $data[3])->value('id');

            if ($firstLine) {
                $firstLine = false;

                continue;
            }

            Locker::create([
                'number' => $data[0],
                'floor_id' => $floor_id,
                'locker_type_id' => $locker_type_id,
                'key_no' => $data[1],
                'status_id' => 1, // 'Available'
            ]);
        }
    }
}

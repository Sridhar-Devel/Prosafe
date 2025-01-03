<?php

namespace Database\Seeders;

use App\Models\Floor;
use Illuminate\Database\Seeder;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Floor::factory()->create(['id' => 1, 'name' => 'Basement']);
        Floor::factory()->create(['id' => 2, 'name' => '1st Floor']);
        Floor::factory()->create(['id' => 3, 'name' => '2nd Floor']);
        Floor::factory()->create(['id' => 4, 'name' => '3rd Floor']);
    }
}

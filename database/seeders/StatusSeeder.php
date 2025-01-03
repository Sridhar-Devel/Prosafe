<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::factory()->create(['id' => 1, 'name' => 'Available']);
        Status::factory()->create(['id' => 2, 'name' => 'Reserved']);
        Status::factory()->create(['id' => 3, 'name' => 'Repair']);
    }
}

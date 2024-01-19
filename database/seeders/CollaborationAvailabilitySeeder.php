<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollaborationAvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('collaboration_availabilities')->insertOrIgnore([
            ['id' => 1, 'value' => 'Morning - Every day'],
            ['id' => 2, 'value' => 'Afternoon - Every day'],
            ['id' => 3, 'value' => 'Night - Every day'],
            ['id' => 4, 'value' => 'Saturday morning'],
            ['id' => 5, 'value' => 'Saturday afternoon'],
        ]);
    }
}

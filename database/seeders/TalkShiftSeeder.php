<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TalkShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('talk_shifts')->insertOrIgnore([
            ['id' => 1, 'value' => 'Morning'],
            ['id' => 2, 'value' => 'Afternoon'],
            ['id' => 3, 'value' => 'Night'],
        ]);
    }
}

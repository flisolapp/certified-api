<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TalkKindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('talk_kinds')->insertOrIgnore([
            ['id' => 1, 'value' => 'Presentation'],
            ['id' => 2, 'value' => 'Workshop'],
        ]);
    }
}

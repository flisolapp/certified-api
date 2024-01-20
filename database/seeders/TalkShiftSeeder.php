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
        DB::table('talk_shifts_i18n')->insertOrIgnore([
            // English (USA)
            ['id' => 1, 'talk_shift_id' => 1, 'language' => 'en', 'value' => 'Morning'],
            ['id' => 2, 'talk_shift_id' => 2, 'language' => 'en', 'value' => 'Afternoon'],
            ['id' => 3, 'talk_shift_id' => 3, 'language' => 'en', 'value' => 'Night'],

            // Spanish (Spain)
            ['id' => 4, 'talk_shift_id' => 1, 'language' => 'en', 'value' => 'Mañana'],
            ['id' => 5, 'talk_shift_id' => 2, 'language' => 'en', 'value' => 'Tarde'],
            ['id' => 6, 'talk_shift_id' => 3, 'language' => 'en', 'value' => 'Noche'],

            // Portuguese (Brazil)
            ['id' => 7, 'talk_shift_id' => 1, 'language' => 'en', 'value' => 'Manhã'],
            ['id' => 8, 'talk_shift_id' => 2, 'language' => 'en', 'value' => 'Tarde'],
            ['id' => 9, 'talk_shift_id' => 3, 'language' => 'en', 'value' => 'Noite'],
        ]);
    }
}

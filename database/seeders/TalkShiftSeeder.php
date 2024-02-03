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
            ['id' => 1, 'parent_id' => 1, 'language' => 'en', 'value' => 'Morning'],
            ['id' => 2, 'parent_id' => 2, 'language' => 'en', 'value' => 'Afternoon'],
            ['id' => 3, 'parent_id' => 3, 'language' => 'en', 'value' => 'Night'],

            // Spanish (Spain)
            ['id' => 4, 'parent_id' => 1, 'language' => 'es', 'value' => 'Mañana'],
            ['id' => 5, 'parent_id' => 2, 'language' => 'es', 'value' => 'Tarde'],
            ['id' => 6, 'parent_id' => 3, 'language' => 'es', 'value' => 'Noche'],

            // Portuguese (Brazil)
            ['id' => 7, 'parent_id' => 1, 'language' => 'pt-BR', 'value' => 'Manhã'],
            ['id' => 8, 'parent_id' => 2, 'language' => 'pt-BR', 'value' => 'Tarde'],
            ['id' => 9, 'parent_id' => 3, 'language' => 'pt-BR', 'value' => 'Noite'],
        ]);
    }
}

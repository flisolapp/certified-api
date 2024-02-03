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
            ['id' => 1, 'value' => 'Lecture'],
            ['id' => 2, 'value' => 'Workshop'],
        ]);
        DB::table('talk_kinds_i18n')->insertOrIgnore([
            // English (USA)
            ['id' => 1, 'parent_id' => 1, 'language' => 'en', 'value' => 'Lecture'],
            ['id' => 2, 'parent_id' => 2, 'language' => 'en', 'value' => 'Workshop'],

            // Spanish (Spain)
            ['id' => 3, 'parent_id' => 1, 'language' => 'es', 'value' => 'Conferencia'],
            ['id' => 4, 'parent_id' => 2, 'language' => 'es', 'value' => 'Taller'],

            // Portuguese (Brazil)
            ['id' => 5, 'parent_id' => 1, 'language' => 'pt-BR', 'value' => 'Palestra'],
            ['id' => 6, 'parent_id' => 2, 'language' => 'pt-BR', 'value' => 'Oficina'],
        ]);
    }
}

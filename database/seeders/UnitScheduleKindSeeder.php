<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitScheduleKindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('unit_schedule_kinds')->insertOrIgnore([
            ['id' => 1, 'value' => 'Event'],
            ['id' => 2, 'value' => 'Main'],
            ['id' => 3, 'value' => 'Talk'],
        ]);
        DB::table('unit_schedule_kinds_i18n')->insertOrIgnore([
            // English (USA)
            ['id' => 1, 'parent_id' => 1, 'language' => 'en', 'value' => 'Main Schedule'],
            ['id' => 2, 'parent_id' => 2, 'language' => 'en', 'value' => 'Event Day'],
            ['id' => 3, 'parent_id' => 3, 'language' => 'en', 'value' => 'Lecture or Workshop'],

            // Spanish (Spain)
            ['id' => 4, 'parent_id' => 1, 'language' => 'es', 'value' => 'Horario principal'],
            ['id' => 5, 'parent_id' => 2, 'language' => 'es', 'value' => 'Día del Evento'],
            ['id' => 6, 'parent_id' => 3, 'language' => 'es', 'value' => 'Conferencia o Taller'],

            // Portuguese (Brazil)
            ['id' => 7, 'parent_id' => 1, 'language' => 'pt-BR', 'value' => 'Cronograma Principal'],
            ['id' => 8, 'parent_id' => 2, 'language' => 'pt-BR', 'value' => 'Dia do Evento'],
            ['id' => 9, 'parent_id' => 3, 'language' => 'pt-BR', 'value' => 'Palestra ou Oficina'],
        ]);
    }
}

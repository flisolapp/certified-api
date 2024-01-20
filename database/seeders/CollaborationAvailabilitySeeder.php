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
            ['id' => 6, 'value' => 'Sunday morning'],
            ['id' => 7, 'value' => 'Sunday afternoon'],
        ]);
        DB::table('collaboration_availabilities_i18n')->insertOrIgnore([
            // English (USA)
            ['id' => 1, 'collaboration_availability_id' => 1, 'language' => 'en', 'value' => 'Morning - Every day'],
            ['id' => 2, 'collaboration_availability_id' => 2, 'language' => 'en', 'value' => 'Afternoon - Every day'],
            ['id' => 3, 'collaboration_availability_id' => 3, 'language' => 'en', 'value' => 'Night - Every day'],
            ['id' => 4, 'collaboration_availability_id' => 4, 'language' => 'en', 'value' => 'Saturday morning'],
            ['id' => 5, 'collaboration_availability_id' => 5, 'language' => 'en', 'value' => 'Saturday afternoon'],
            ['id' => 6, 'collaboration_availability_id' => 6, 'language' => 'en', 'value' => 'Sunday morning'],
            ['id' => 7, 'collaboration_availability_id' => 7, 'language' => 'en', 'value' => 'Sunday afternoon'],

            // Spanish (Spain)
            ['id' => 8, 'collaboration_availability_id' => 1, 'language' => 'es', 'value' => 'Mañana - Todos los días'],
            ['id' => 9, 'collaboration_availability_id' => 2, 'language' => 'es', 'value' => 'Tarde - Todos los días'],
            ['id' => 10, 'collaboration_availability_id' => 3, 'language' => 'es', 'value' => 'Noche - Todos los días'],
            ['id' => 11, 'collaboration_availability_id' => 4, 'language' => 'es', 'value' => 'Sábado por la mañana'],
            ['id' => 12, 'collaboration_availability_id' => 5, 'language' => 'es', 'value' => 'Sábado por la tarde'],
            ['id' => 13, 'collaboration_availability_id' => 6, 'language' => 'es', 'value' => 'Domingo por la mañana'],
            ['id' => 14, 'collaboration_availability_id' => 7, 'language' => 'es', 'value' => 'Domingo por la tarde'],

            // Portuguese (Brazil)
            ['id' => 15, 'collaboration_availability_id' => 1, 'language' => 'pt-BR', 'value' => 'Manhã - Todos os dias'],
            ['id' => 16, 'collaboration_availability_id' => 2, 'language' => 'pt-BR', 'value' => 'Tarde - Todos os dias'],
            ['id' => 17, 'collaboration_availability_id' => 3, 'language' => 'pt-BR', 'value' => 'Noite - Todos os dias'],
            ['id' => 18, 'collaboration_availability_id' => 4, 'language' => 'pt-BR', 'value' => 'Sábado de manhã'],
            ['id' => 19, 'collaboration_availability_id' => 5, 'language' => 'pt-BR', 'value' => 'Sábado à tarde'],
            ['id' => 20, 'collaboration_availability_id' => 6, 'language' => 'pt-BR', 'value' => 'Domingo de manhã'],
            ['id' => 21, 'collaboration_availability_id' => 7, 'language' => 'pt-BR', 'value' => 'Domingo à tarde'],
        ]);
    }
}

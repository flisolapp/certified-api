<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('student_infos')->insertOrIgnore([
            ['id' => 1, 'value' => 'Yes, I\'m a student'],
            ['id' => 2, 'value' => 'Yes, in high school'],
            ['id' => 3, 'value' => 'Yes, in technical high school'],
            ['id' => 4, 'value' => 'Yes, in higher education'],
            ['id' => 5, 'value' => 'No, I have already finished higher education'],
            ['id' => 6, 'value' => 'No, I\'m just working'],
            ['id' => 7, 'value' => 'No, I\'m not studying or working'],
            ['id' => 8, 'value' => 'No, I\'m a teacher'],
        ]);
        DB::table('student_infos_i18n')->insertOrIgnore([
            // English (USA)
            ['id' => 1, 'student_info_id' => 1, 'language' => 'en', 'value' => 'Yes, I\'m a student'],
            ['id' => 2, 'student_info_id' => 2, 'language' => 'en', 'value' => 'Yes, in high school'],
            ['id' => 3, 'student_info_id' => 3, 'language' => 'en', 'value' => 'Yes, in technical high school'],
            ['id' => 4, 'student_info_id' => 4, 'language' => 'en', 'value' => 'Yes, in higher education'],
            ['id' => 5, 'student_info_id' => 5, 'language' => 'en', 'value' => 'No, I\'m just working'],
            ['id' => 6, 'student_info_id' => 6, 'language' => 'en', 'value' => 'No, solo estoy trabajando'],
            ['id' => 7, 'student_info_id' => 7, 'language' => 'en', 'value' => 'No, I\'m not studying or working'],
            ['id' => 8, 'student_info_id' => 8, 'language' => 'en', 'value' => 'No, I\'m a teacher'],

            // Spanish (Spain)
            ['id' => 9, 'student_info_id' => 1, 'language' => 'es', 'value' => 'Sí, soy un estudiante'],
            ['id' => 10, 'student_info_id' => 2, 'language' => 'es', 'value' => 'Sí, en la secundaria'],
            ['id' => 11, 'student_info_id' => 3, 'language' => 'es', 'value' => 'Sí, en la secundaria técnica'],
            ['id' => 12, 'student_info_id' => 4, 'language' => 'es', 'value' => 'Sí, en la educación superior'],
            ['id' => 13, 'student_info_id' => 5, 'language' => 'es', 'value' => 'No, ya terminé la educación superior'],
            ['id' => 14, 'student_info_id' => 6, 'language' => 'es', 'value' => 'No, solo estoy trabajando'],
            ['id' => 15, 'student_info_id' => 7, 'language' => 'es', 'value' => 'No, no estoy estudiando ni trabajando'],
            ['id' => 16, 'student_info_id' => 8, 'language' => 'es', 'value' => 'No, soy profesor'],

            // Portuguese (Brazil)
            ['id' => 17, 'student_info_id' => 1, 'language' => 'pt-BR', 'value' => 'Sim, sou estudante'],
            ['id' => 18, 'student_info_id' => 2, 'language' => 'pt-BR', 'value' => 'Sim, no ensino médio'],
            ['id' => 19, 'student_info_id' => 3, 'language' => 'pt-BR', 'value' => 'Sim, no ensino médio técnico'],
            ['id' => 20, 'student_info_id' => 4, 'language' => 'pt-BR', 'value' => 'Sim, no ensino superior'],
            ['id' => 21, 'student_info_id' => 5, 'language' => 'pt-BR', 'value' => 'Não, já terminei o ensino superior'],
            ['id' => 22, 'student_info_id' => 6, 'language' => 'pt-BR', 'value' => 'Não, só estou trabalhando'],
            ['id' => 23, 'student_info_id' => 7, 'language' => 'pt-BR', 'value' => 'Não, não estou estudando nem trabalhando'],
            ['id' => 24, 'student_info_id' => 8, 'language' => 'pt-BR', 'value' => 'Não, sou professor'],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TalkSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('talk_subjects')->insertOrIgnore([
            ['id' => 1, 'value' => 'Free Accessibility (Applications for people with physical needs)'],
            ['id' => 2, 'value' => 'Cryptotechnologies'],
            ['id' => 3, 'value' => 'Development (Programming)'],
            ['id' => 4, 'value' => 'Image Design'],
            ['id' => 5, 'value' => 'Free Software Ecosystem'],
            ['id' => 6, 'value' => 'Education'],
            ['id' => 7, 'value' => 'Flisolzinho (Workshop aimed at children)'],
            ['id' => 8, 'value' => 'Games'],
            ['id' => 9, 'value' => 'Project Management'],
            ['id' => 10, 'value' => 'Data Governance'],
            ['id' => 11, 'value' => 'Internet of Things'],
            ['id' => 12, 'value' => 'Networks'],
            ['id' => 13, 'value' => 'Free Robotics'],
            ['id' => 14, 'value' => 'Security and Privacy'],
            ['id' => 15, 'value' => 'Operational Systems'],
            ['id' => 16, 'value' => 'Public Software'],
            ['id' => 17, 'value' => 'Startups and Entrepreneurship'],
            ['id' => 18, 'value' => 'Green IT (Sustainability)'],
            ['id' => 19, 'value' => 'Web'],
        ]);
        DB::table('talk_subjects_i18n')->insertOrIgnore([
            // English (USA)
            ['id' => 1, 'parent_id' => 1, 'language' => 'en', 'value' => 'Free Accessibility (Applications for people with physical needs)'],
            ['id' => 2, 'parent_id' => 2, 'language' => 'en', 'value' => 'Cryptotechnologies'],
            ['id' => 3, 'parent_id' => 3, 'language' => 'en', 'value' => 'Development (Programming)'],
            ['id' => 4, 'parent_id' => 4, 'language' => 'en', 'value' => 'Image Design'],
            ['id' => 5, 'parent_id' => 5, 'language' => 'en', 'value' => 'Free Software Ecosystem'],
            ['id' => 6, 'parent_id' => 6, 'language' => 'en', 'value' => 'Education'],
            ['id' => 7, 'parent_id' => 7, 'language' => 'en', 'value' => 'Flisolzinho (Workshop aimed at children)'],
            ['id' => 8, 'parent_id' => 8, 'language' => 'en', 'value' => 'Games'],
            ['id' => 9, 'parent_id' => 9, 'language' => 'en', 'value' => 'Project Management'],
            ['id' => 10, 'parent_id' => 10, 'language' => 'en', 'value' => 'Data Governance'],
            ['id' => 11, 'parent_id' => 11, 'language' => 'en', 'value' => 'Internet of Things (IoT)'],
            ['id' => 12, 'parent_id' => 12, 'language' => 'en', 'value' => 'Networks'],
            ['id' => 13, 'parent_id' => 13, 'language' => 'en', 'value' => 'Free Robotics'],
            ['id' => 14, 'parent_id' => 14, 'language' => 'en', 'value' => 'Security and Privacy'],
            ['id' => 15, 'parent_id' => 15, 'language' => 'en', 'value' => 'Operational Systems'],
            ['id' => 16, 'parent_id' => 16, 'language' => 'en', 'value' => 'Public Software'],
            ['id' => 17, 'parent_id' => 17, 'language' => 'en', 'value' => 'Startups and Entrepreneurship'],
            ['id' => 18, 'parent_id' => 18, 'language' => 'en', 'value' => 'Green IT (Sustainability)'],
            ['id' => 19, 'parent_id' => 19, 'language' => 'en', 'value' => 'Web'],

            // Spanish (Spain)
            ['id' => 20, 'parent_id' => 1, 'language' => 'es', 'value' => 'Accesibilidad Gratuita (Aplicaciones para personas con necesidades físicas)'],
            ['id' => 21, 'parent_id' => 2, 'language' => 'es', 'value' => 'Criptotecnologías'],
            ['id' => 22, 'parent_id' => 3, 'language' => 'es', 'value' => 'Desarrollo (Programación)'],
            ['id' => 23, 'parent_id' => 4, 'language' => 'es', 'value' => 'Diseño de Imagen'],
            ['id' => 24, 'parent_id' => 5, 'language' => 'es', 'value' => 'Ecosistema de Software Libre'],
            ['id' => 25, 'parent_id' => 6, 'language' => 'es', 'value' => 'Educación'],
            ['id' => 26, 'parent_id' => 7, 'language' => 'es', 'value' => 'Flisolzinho (Taller dirigido a niños)'],
            ['id' => 27, 'parent_id' => 8, 'language' => 'es', 'value' => 'Games'],
            ['id' => 28, 'parent_id' => 9, 'language' => 'es', 'value' => 'Gestión de Proyectos'],
            ['id' => 29, 'parent_id' => 10, 'language' => 'es', 'value' => 'Dato de Governancia'],
            ['id' => 30, 'parent_id' => 11, 'language' => 'es', 'value' => 'Internet de las Cosas (IoT)'],
            ['id' => 31, 'parent_id' => 12, 'language' => 'es', 'value' => 'Redes'],
            ['id' => 32, 'parent_id' => 13, 'language' => 'es', 'value' => 'Robótica Libre'],
            ['id' => 33, 'parent_id' => 14, 'language' => 'es', 'value' => 'Seguridad y Privacidad'],
            ['id' => 34, 'parent_id' => 15, 'language' => 'es', 'value' => 'Sistemas Operativos'],
            ['id' => 35, 'parent_id' => 16, 'language' => 'es', 'value' => 'Software Público'],
            ['id' => 36, 'parent_id' => 17, 'language' => 'es', 'value' => 'Startups y Emprendimiento'],
            ['id' => 37, 'parent_id' => 18, 'language' => 'es', 'value' => 'TI Verde (Sostenibilidad)'],
            ['id' => 38, 'parent_id' => 19, 'language' => 'es', 'value' => 'Web'],

            // Portuguese (Brazil)
            ['id' => 39, 'parent_id' => 1, 'language' => 'pt-BR', 'value' => 'Acessibilidade Gratuita (Aplicações para pessoas com necessidades físicas)'],
            ['id' => 40, 'parent_id' => 2, 'language' => 'pt-BR', 'value' => 'Criptotecnologias'],
            ['id' => 41, 'parent_id' => 3, 'language' => 'pt-BR', 'value' => 'Desenvolvimento (Programação)'],
            ['id' => 42, 'parent_id' => 4, 'language' => 'pt-BR', 'value' => 'Design de Imagem'],
            ['id' => 43, 'parent_id' => 5, 'language' => 'pt-BR', 'value' => 'Ecossistema de Software Livre'],
            ['id' => 44, 'parent_id' => 6, 'language' => 'pt-BR', 'value' => 'Educação'],
            ['id' => 45, 'parent_id' => 7, 'language' => 'pt-BR', 'value' => 'Flisolzinho (Oficina voltada para crianças)'],
            ['id' => 46, 'parent_id' => 8, 'language' => 'pt-BR', 'value' => 'Games'],
            ['id' => 47, 'parent_id' => 9, 'language' => 'pt-BR', 'value' => 'Gerenciamento de Projetos'],
            ['id' => 48, 'parent_id' => 10, 'language' => 'pt-BR', 'value' => 'Governança de Dados'],
            ['id' => 49, 'parent_id' => 11, 'language' => 'pt-BR', 'value' => 'Internet das Coisas (IoT)'],
            ['id' => 50, 'parent_id' => 12, 'language' => 'pt-BR', 'value' => 'Redes'],
            ['id' => 51, 'parent_id' => 13, 'language' => 'pt-BR', 'value' => 'Robótica Livre'],
            ['id' => 52, 'parent_id' => 14, 'language' => 'pt-BR', 'value' => 'Segurança e Privacidade'],
            ['id' => 53, 'parent_id' => 15, 'language' => 'pt-BR', 'value' => 'Sistemas Operacionais'],
            ['id' => 54, 'parent_id' => 16, 'language' => 'pt-BR', 'value' => 'Software Público'],
            ['id' => 55, 'parent_id' => 17, 'language' => 'pt-BR', 'value' => 'Startups e Empreendedorismo'],
            ['id' => 56, 'parent_id' => 18, 'language' => 'pt-BR', 'value' => 'TI Verde (Sustentabilidade)'],
            ['id' => 57, 'parent_id' => 19, 'language' => 'pt-BR', 'value' => 'Web'],
        ]);
    }
}

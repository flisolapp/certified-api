<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollaborationAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('collaboration_areas')->insertOrIgnore([
            ['id' => 1, 'value' => 'In search of sponsorship and support'],
            ['id' => 2, 'value' => 'In advertising and dissemination (social networks)'],
            ['id' => 3, 'value' => 'In organizing the blog'],
            ['id' => 4, 'value' => 'In registration control (participants and speakers, certificates and control of activities)'],
            ['id' => 5, 'value' => 'In the technological infrastructure (local network and wifi, servers and repositories)'],
            ['id' => 6, 'value' => 'In the installation workshop (InstallFest) and recording images on media'],
            ['id' => 7, 'value' => 'Theme (Other lectures, workshops and short courses)'],
            ['id' => 8, 'value' => 'Registration system'],
            ['id' => 9, 'value' => 'Room organization'],
            ['id' => 10, 'value' => 'Visit and publicity in other schools or locations'],
            ['id' => 11, 'value' => 'Filming, photography and documentary of the event'],
            ['id' => 12, 'value' => 'Graphic art and graphic material'],
            ['id' => 13, 'value' => 'Collaborative communication (real-time dissemination on social media)'],
        ]);
        DB::table('collaboration_areas_i18n')->insertOrIgnore([
            // English (USA)
            ['id' => 1, 'parent_id' => 1, 'language' => 'en', 'value' => 'In search of sponsorship and support'],
            ['id' => 2, 'parent_id' => 2, 'language' => 'en', 'value' => 'In advertising and dissemination (social networks)'],
            ['id' => 3, 'parent_id' => 3, 'language' => 'en', 'value' => 'In organizing the blog'],
            ['id' => 4, 'parent_id' => 4, 'language' => 'en', 'value' => 'In registration control (participants and speakers, certificates and control of activities)'],
            ['id' => 5, 'parent_id' => 5, 'language' => 'en', 'value' => 'In the technological infrastructure (local network and wifi, servers and repositories)'],
            ['id' => 6, 'parent_id' => 6, 'language' => 'en', 'value' => 'In the installation workshop (InstallFest) and recording images on media'],
            ['id' => 7, 'parent_id' => 7, 'language' => 'en', 'value' => 'Theme (Other lectures, workshops and short courses)'],
            ['id' => 8, 'parent_id' => 8, 'language' => 'en', 'value' => 'Registration system'],
            ['id' => 9, 'parent_id' => 9, 'language' => 'en', 'value' => 'Rooms organization'],
            ['id' => 10, 'parent_id' => 10, 'language' => 'en', 'value' => 'Visit and publicity in other schools or places'],
            ['id' => 11, 'parent_id' => 11, 'language' => 'en', 'value' => 'Filming, photography and documentary of the event'],
            ['id' => 12, 'parent_id' => 12, 'language' => 'en', 'value' => 'Graphic art and graphic material'],
            ['id' => 13, 'parent_id' => 13, 'language' => 'en', 'value' => 'Collaborative communication (real-time dissemination on social media)'],

            // Spanish (Spain)
            ['id' => 14, 'parent_id' => 1, 'language' => 'es', 'value' => 'En busca de patrocinio y apoyo'],
            ['id' => 15, 'parent_id' => 2, 'language' => 'es', 'value' => 'En publicidad y difusión (redes sociales)'],
            ['id' => 16, 'parent_id' => 3, 'language' => 'es', 'value' => 'En la organización del blog'],
            ['id' => 17, 'parent_id' => 4, 'language' => 'es', 'value' => 'En control de inscripciones (participantes y ponentes, certificados y control de actividades)'],
            ['id' => 18, 'parent_id' => 5, 'language' => 'es', 'value' => 'En la infraestructura tecnológica (red local y wifi, servidores y repositorios)'],
            ['id' => 19, 'parent_id' => 6, 'language' => 'es', 'value' => 'En el taller de instalación (InstallFest) y grabación de imágenes en soporte.'],
            ['id' => 20, 'parent_id' => 7, 'language' => 'es', 'value' => 'Tema (Otras conferencias, talleres y cursos cortos)'],
            ['id' => 21, 'parent_id' => 8, 'language' => 'es', 'value' => 'Sistema de registro'],
            ['id' => 22, 'parent_id' => 9, 'language' => 'es', 'value' => 'Organización de las habitaciones'],
            ['id' => 23, 'parent_id' => 10, 'language' => 'es', 'value' => 'Visita y publicidad en otras escuelas o lugares'],
            ['id' => 24, 'parent_id' => 11, 'language' => 'es', 'value' => 'Filmación, fotografía y documental del evento'],
            ['id' => 25, 'parent_id' => 12, 'language' => 'es', 'value' => 'Arte gráfico y material gráfico'],
            ['id' => 26, 'parent_id' => 13, 'language' => 'es', 'value' => 'Comunicación colaborativa (difusión en tiempo real en redes sociales)'],

            // Portuguese (Brazil)
            ['id' => 27, 'parent_id' => 1, 'language' => 'pt-BR', 'value' => 'Em busca de patrocínio e apoio'],
            ['id' => 28, 'parent_id' => 2, 'language' => 'pt-BR', 'value' => 'Na publicidade e divulgação (redes sociais)'],
            ['id' => 29, 'parent_id' => 3, 'language' => 'pt-BR', 'value' => 'Na organização do blog'],
            ['id' => 30, 'parent_id' => 4, 'language' => 'pt-BR', 'value' => 'No controle de inscrições (participantes e palestrantes, certificados e controle de atividades)'],
            ['id' => 31, 'parent_id' => 5, 'language' => 'pt-BR', 'value' => 'Na infraestrutura tecnológica (rede local e wifi, servidores e repositórios)'],
            ['id' => 32, 'parent_id' => 6, 'language' => 'pt-BR', 'value' => 'Na oficina de instalação (InstallFest) e gravação de imagens em mídia'],
            ['id' => 33, 'parent_id' => 7, 'language' => 'pt-BR', 'value' => 'Tema (Outras palestras, workshops e minicursos)'],
            ['id' => 34, 'parent_id' => 8, 'language' => 'pt-BR', 'value' => 'Sistema de registro'],
            ['id' => 35, 'parent_id' => 9, 'language' => 'pt-BR', 'value' => 'Organização das salas'],
            ['id' => 36, 'parent_id' => 10, 'language' => 'pt-BR', 'value' => 'Visita e divulgação em outras escolas ou lugares'],
            ['id' => 37, 'parent_id' => 11, 'language' => 'pt-BR', 'value' => 'Filmagem, fotografia e documentário do evento'],
            ['id' => 38, 'parent_id' => 12, 'language' => 'pt-BR', 'value' => 'Arte gráfica e material gráfico'],
            ['id' => 39, 'parent_id' => 13, 'language' => 'pt-BR', 'value' => 'Comunicação colaborativa (divulgação em tempo real nas redes sociais)'],
        ]);
    }
}

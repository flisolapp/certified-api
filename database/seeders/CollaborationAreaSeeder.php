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
    }
}

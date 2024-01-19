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
    }
}

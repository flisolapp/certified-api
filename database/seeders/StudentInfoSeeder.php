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
    }
}

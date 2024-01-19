<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('editions')->insertOrIgnore([
            ['id' => 1, 'year' => 2005, 'active' => 0, 'created_at' => '2019-03-03 23:19:52', 'updated_at' => '2019-03-03 23:19:52'],
            ['id' => 2, 'year' => 2006, 'active' => 0, 'created_at' => '2019-03-03 23:19:52', 'updated_at' => '2019-03-03 23:19:52'],
            ['id' => 3, 'year' => 2007, 'active' => 0, 'created_at' => '2019-03-03 23:19:52', 'updated_at' => '2019-03-03 23:19:52'],
            ['id' => 4, 'year' => 2008, 'active' => 0, 'created_at' => '2019-03-03 23:19:52', 'updated_at' => '2019-03-03 23:19:52'],
            ['id' => 5, 'year' => 2009, 'active' => 0, 'created_at' => '2019-03-03 23:19:52', 'updated_at' => '2019-03-03 23:19:52'],
            ['id' => 6, 'year' => 2010, 'active' => 0, 'created_at' => '2019-03-03 23:19:52', 'updated_at' => '2019-03-03 23:19:52'],
            ['id' => 7, 'year' => 2011, 'active' => 0, 'created_at' => '2019-03-03 23:19:52', 'updated_at' => '2019-03-03 23:19:52'],
            ['id' => 8, 'year' => 2012, 'active' => 0, 'created_at' => '2019-03-03 23:19:52', 'updated_at' => '2019-03-03 23:19:52'],
            ['id' => 9, 'year' => 2013, 'active' => 0, 'created_at' => '2019-03-03 23:19:52', 'updated_at' => '2019-03-03 23:19:52'],
            ['id' => 10, 'year' => 2014, 'active' => 0, 'created_at' => '2019-03-03 23:19:52', 'updated_at' => '2019-03-03 23:19:52'],
            ['id' => 11, 'year' => 2015, 'active' => 0, 'created_at' => '2019-03-03 23:19:52', 'updated_at' => '2019-03-03 23:19:52'],
            ['id' => 12, 'year' => 2016, 'active' => 0, 'created_at' => '2019-03-03 23:19:52', 'updated_at' => '2019-03-03 23:19:52'],
            ['id' => 13, 'year' => 2017, 'active' => 0, 'created_at' => '2019-03-03 23:19:52', 'updated_at' => '2019-03-03 23:19:52'],
            ['id' => 14, 'year' => 2018, 'active' => 0, 'created_at' => '2019-03-03 23:19:52', 'updated_at' => '2019-03-03 23:19:52'],
            ['id' => 15, 'year' => 2019, 'active' => 0, 'created_at' => '2019-03-03 23:19:52', 'updated_at' => '2019-03-03 23:19:52'],
            ['id' => 16, 'year' => 2020, 'active' => 0, 'created_at' => '2020-03-08 20:47:00', 'updated_at' => '2020-03-08 20:47:00'],
            ['id' => 17, 'year' => 2021, 'active' => 0, 'created_at' => '2021-03-28 21:31:15', 'updated_at' => '2021-03-28 21:31:15'],
            ['id' => 18, 'year' => 2022, 'active' => 0, 'created_at' => '2022-03-28 21:31:15', 'updated_at' => '2022-03-28 21:31:15'],
            ['id' => 19, 'year' => 2023, 'active' => 0, 'created_at' => '2023-02-19 17:53:31', 'updated_at' => '2023-02-19 17:53:31'],
            ['id' => 20, 'year' => 2024, 'active' => 1, 'created_at' => '2024-01-18 10:33:14', 'updated_at' => '2024-01-18 10:33:14'],
        ]);
    }
}

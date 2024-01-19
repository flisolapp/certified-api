<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('distros')->insertOrIgnore([
            ['id' => 1, 'name' => 'I don\'t use Linux'],
            ['id' => 2, 'name' => 'BigLinux'],
            ['id' => 3, 'name' => 'Debian'],
            ['id' => 4, 'name' => 'Duzeru'],
            ['id' => 5, 'name' => 'Educatux'],
            ['id' => 6, 'name' => 'Elementary OS'],
            ['id' => 7, 'name' => 'Fedora'],
            ['id' => 8, 'name' => 'Kaiana'],
            ['id' => 9, 'name' => 'Kali Linux'],
            ['id' => 10, 'name' => 'LinuxMint'],
            ['id' => 11, 'name' => 'LXLE'],
            ['id' => 12, 'name' => 'SlackWare'],
            ['id' => 13, 'name' => 'Suse'],
            ['id' => 14, 'name' => 'Tails'],
            ['id' => 15, 'name' => 'Trisquel'],
            ['id' => 16, 'name' => 'Ubuntu/Kubuntu'],
            ['id' => 17, 'name' => 'Other'],
        ]);
    }
}

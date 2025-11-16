<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_level')->insert([
            [
                'level' => 'administrator',
            ],
            [
                'level' => 'petugas',
            ]
        ]);
    }
}

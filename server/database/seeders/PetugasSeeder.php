<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Petugas::create([
            'nama_petugas' => 'Fahmirizal Budi Ramadhan',
            'username' => 'fahmirizal554',
            'password' => bcrypt('270908'),
            'id_level' => 1
        ]);
    }
}

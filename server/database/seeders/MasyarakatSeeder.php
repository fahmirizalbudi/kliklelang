<?php

namespace Database\Seeders;

use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasyarakatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $masyarakats = [
            ['nama_lengkap' => 'Andi Pratama', 'username' => 'andi123', 'password' => Hash::make('password1'), 'telp' => '081234567890'],
            ['nama_lengkap' => 'Budi Santoso', 'username' => 'budi456', 'password' => Hash::make('password2'), 'telp' => '081234567891'],
            ['nama_lengkap' => 'Citra Dewi', 'username' => 'citra789', 'password' => Hash::make('password3'), 'telp' => '081234567892'],
            ['nama_lengkap' => 'Dedi Kurniawan', 'username' => 'dedi321', 'password' => Hash::make('password4'), 'telp' => '081234567893'],
            ['nama_lengkap' => 'Eka Putri', 'username' => 'eka654', 'password' => Hash::make('password5'), 'telp' => '081234567894'],
            ['nama_lengkap' => 'Fajar Hadi', 'username' => 'fajar987', 'password' => Hash::make('password6'), 'telp' => '081234567895'],
            ['nama_lengkap' => 'Gita Lestari', 'username' => 'gita147', 'password' => Hash::make('password7'), 'telp' => '081234567896'],
            ['nama_lengkap' => 'Hendra Wijaya', 'username' => 'hendra258', 'password' => Hash::make('password8'), 'telp' => '081234567897'],
            ['nama_lengkap' => 'Intan Permata', 'username' => 'intan369', 'password' => Hash::make('password9'), 'telp' => '081234567898'],
            ['nama_lengkap' => 'Joko Susilo', 'username' => 'joko159', 'password' => Hash::make('password10'), 'telp' => '081234567899'],
        ];

        DB::table('tb_masyarakat')->insert($masyarakats);
    }
}

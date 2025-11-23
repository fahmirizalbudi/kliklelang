<?php

namespace Database\Seeders;

use App\Models\Masyarakat;
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
            [
                'nik' => '3201010100000001',
                'nama_lengkap' => 'Andi Pratama',
                'username' => 'andi123',
                'password' => Hash::make('password1'),
                'telp' => '081234567890',
                'alamat' => 'Jl. Merdeka No.1, Jakarta'
            ],
            [
                'nik' => '3201010100000002',
                'nama_lengkap' => 'Budi Santoso',
                'username' => 'budi456',
                'password' => Hash::make('password2'),
                'telp' => '081234567891',
                'alamat' => 'Jl. Sudirman No.2, Jakarta'
            ],
            [
                'nik' => '3201010100000003',
                'nama_lengkap' => 'Citra Dewi',
                'username' => 'citra789',
                'password' => Hash::make('password3'),
                'telp' => '081234567892',
                'alamat' => 'Jl. Thamrin No.3, Jakarta'
            ],
            [
                'nik' => '3201010100000004',
                'nama_lengkap' => 'Dedi Kurniawan',
                'username' => 'dedi321',
                'password' => Hash::make('password4'),
                'telp' => '081234567893',
                'alamat' => 'Jl. Gatot Subroto No.4, Jakarta'
            ],
            [
                'nik' => '3201010100000005',
                'nama_lengkap' => 'Eka Putri',
                'username' => 'eka654',
                'password' => Hash::make('password5'),
                'telp' => '081234567894',
                'alamat' => 'Jl. Diponegoro No.5, Jakarta'
            ],
            [
                'nik' => '3201010100000006',
                'nama_lengkap' => 'Fajar Hadi',
                'username' => 'fajar987',
                'password' => Hash::make('password6'),
                'telp' => '081234567895',
                'alamat' => 'Jl. Mangga Dua No.6, Jakarta'
            ],
            [
                'nik' => '3201010100000007',
                'nama_lengkap' => 'Gita Lestari',
                'username' => 'gita147',
                'password' => Hash::make('password7'),
                'telp' => '081234567896',
                'alamat' => 'Jl. Kebon Jeruk No.7, Jakarta'
            ],
            [
                'nik' => '3201010100000008',
                'nama_lengkap' => 'Hendra Wijaya',
                'username' => 'hendra258',
                'password' => Hash::make('password8'),
                'telp' => '081234567897',
                'alamat' => 'Jl. Palmerah No.8, Jakarta'
            ],
            [
                'nik' => '3201010100000009',
                'nama_lengkap' => 'Intan Permata',
                'username' => 'intan369',
                'password' => Hash::make('password9'),
                'telp' => '081234567898',
                'alamat' => 'Jl. Kemang No.9, Jakarta'
            ],
            [
                'nik' => '3201010100000010',
                'nama_lengkap' => 'Joko Susilo',
                'username' => 'joko159',
                'password' => Hash::make('password10'),
                'telp' => '081234567899',
                'alamat' => 'Jl. Cikini No.10, Jakarta'
            ],
        ];

        Masyarakat::insert($masyarakats);
    }
}

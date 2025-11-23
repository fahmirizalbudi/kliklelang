<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangs = [
            ['foto' => 'acer-aspire-laptop.jpg', 'nama' => 'Acer Aspire Laptop Series', 'harga' => 4500000],
            ['foto' => 'apple-i-watch.jpg', 'nama' => 'Apple iWatch Smart Series', 'harga' => 3500000],
            ['foto' => 'apple-iphone-se.jpg', 'nama' => 'Apple iPhone SE Edition', 'harga' => 2800000],
            ['foto' => 'huawei-pura70-pro.jpg', 'nama' => 'Huawei Pura 70 Pro', 'harga' => 9000000],
            ['foto' => 'imac-2024.jpg', 'nama' => 'Apple iMac 2024', 'harga' => 16000000],
            ['foto' => 'ipad.png', 'nama' => 'Apple iPad Standard', 'harga' => 5500000],
            ['foto' => 'iphone-x.jpg', 'nama' => 'Apple iPhone X', 'harga' => 3200000],
            ['foto' => 'macbook-air-m1.jpg', 'nama' => 'MacBook Air M1', 'harga' => 8500000],
            ['foto' => 'macbook-pro-m3.jpg', 'nama' => 'MacBook Pro M3', 'harga' => 19000000],
            ['foto' => 'microsoft-surface-laptop.webp', 'nama' => 'Microsoft Surface Laptop', 'harga' => 6500000],
            ['foto' => 'nintendo-gameboy.jpg', 'nama' => 'Nintendo Gameboy Classic', 'harga' => 1500000],
            ['foto' => 'nintendo-nes.jpg', 'nama' => 'Nintendo NES Console', 'harga' => 2200000],
            ['foto' => 'nintendo-switch.jpg', 'nama' => 'Nintendo Switch Console', 'harga' => 4500000],
            ['foto' => 'playstation-4-with-gamepad.jpg', 'nama' => 'PlayStation 4 Bundle', 'harga' => 3000000],
            ['foto' => 'playstation-5-digital-with-gamepad.jpg', 'nama' => 'PlayStation 5 Digital', 'harga' => 8500000],
            ['foto' => 'samsung-s24.jpg', 'nama' => 'Samsung Galaxy S24', 'harga' => 9500000],
            ['foto' => 'xbox-gamepad.jpg', 'nama' => 'Xbox Wireless Gamepad', 'harga' => 900000],
            ['foto' => 'xbox-series-s.jpg', 'nama' => 'Xbox Series S Console', 'harga' => 4500000],
        ];

        foreach ($barangs as $barang) {
            Barang::insert([
                'nama_barang' => $barang['nama'],
                'tgl' => now()->toDateString(),
                'harga_awal' => $barang['harga'],
                'deskripsi_barang' =>
                    $barang['nama'] . ' merupakan produk berkualitas dengan spesifikasi yang sangat baik di kelasnya. Barang ini cocok untuk berbagai kebutuhan pengguna, mulai dari penggunaan sehari-hari hingga aktivitas profesional. Kondisi barang disiapkan dengan baik dan layak untuk dilelang.',
                'foto_barang' => $barang['foto'],
            ]);
        }
    }
}

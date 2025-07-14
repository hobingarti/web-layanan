<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Layanan;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Layanan::truncate(); // Clear existing data
        
        Layanan::create([
            'jenis_layanan_id' => 1,
            'nik_warga' => '1234567890123456',
            'nama_warga' => 'Budi Santoso',
            'alamat_domisili' => 'Jl. Merdeka No. 1',
            'lingkungan_domisili' => 'Lingkungan 1',
        ]);

        Layanan::create([
            'jenis_layanan_id' => 2,
            'nik_warga' => '2345678901234567',
            'nama_warga' => 'Siti Aminah',
            'alamat_domisili' => 'Jl. Sudirman No. 2',
            'lingkungan_domisili' => 'Lingkungan 2',
        ]);
    }
}

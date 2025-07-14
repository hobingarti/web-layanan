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
            'jenis_layanan_id' => 6,
            'warga_id' => 1,
            'kode_arsip' => 'Lingkungan 1',
            'hasil_pelayanan' => 'Lingkungan 1',
            'keterangan' => 'Lingkungan 1',
        ]);

        Layanan::create([
            'jenis_layanan_id' => 6,
            'warga_id' => 2,
            'kode_arsip' => 'Lingkungan 2',
            'hasil_pelayanan' => 'Lingkungan 2',
            'keterangan' => 'Lingkungan 2',
        ]);

        for ($i = 3; $i <= 20; $i++) {
            Layanan::create([
                'jenis_layanan_id' => 6,
                'warga_id' => $i,
                'kode_arsip' => "Lingkungan $i",
                'hasil_pelayanan' => "Lingkungan $i",
                'keterangan' => "Lingkungan $i",
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Warga;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Warga::truncate(); // Clear existing data

        // for ($i = 1; $i <= 20; $i++) {
        //     Warga::create([
        //         'nik' => str_pad($i, 16, '0', STR_PAD_LEFT),
        //         'nama' => "Warga $i",
        //         'alamat_domisili' => "Alamat $i",
        //         'lingkungan_domisili' => "Lingkungan $i"
        //     ]);
        // }
    }
}

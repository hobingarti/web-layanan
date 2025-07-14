<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisLayanan;

class JenisLayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisLayanan::truncate(); // Clear existing data
        // Create root jenis layanan 1
        JenisLayanan::create([
            'nama_jenis_layanan' => 'Layanan Perizinan',
            'icon_jenis_layanan' => 'icon-utama',
            'keterangan' => 'Jenis layanan utama yang tersedia.',
            'is_aktif' => true,
            'parent_id' => 0,
        ]);
        // Create root jenis layanan 2
        JenisLayanan::create([
            'nama_jenis_layanan' => 'Layanan Non-Perizinan',
            'icon_jenis_layanan' => 'icon-utama',
            'keterangan' => 'Jenis layanan utama yang tersedia.',
            'is_aktif' => true,
            'parent_id' => 0,
        ]);

        // Create child jenis layanan 1
        JenisLayanan::create([
            'nama_jenis_layanan' => 'Izin Mendirikan Bangunan',
            'icon_jenis_layanan' => 'icon-child',
            'keterangan' => 'Layanan pembuatan Izin Mendirikan Bangunan',
            'is_aktif' => true,
            'parent_id' => 1, // Parent is "Layanan Perizinan"
        ]);
        JenisLayanan::create([
            'nama_jenis_layanan' => 'Izin Usaha Mikro dan Kecil',
            'icon_jenis_layanan' => 'icon-child',
            'keterangan' => 'Layanan pembuatan Izin Usaha Mikro dan Kecil',
            'is_aktif' => true,
            'parent_id' => 1, // Parent is "Layanan Perizinan"
        ]);

        // Create child jenis layanan 2
        JenisLayanan::create([
            'nama_jenis_layanan' => 'Permohonan Silsilah dan Waris',
            'icon_jenis_layanan' => 'icon-child',
            'keterangan' => 'Layanan pembuatan Silsilah dan Waris',
            'is_aktif' => true,
            'parent_id' => 2, // Parent is "Layanan Non Perizinan"
        ]);

        JenisLayanan::create([
            'nama_jenis_layanan' => 'Pendataan Penduduk Non Permanen',
            'icon_jenis_layanan' => 'icon-child',
            'keterangan' => 'Layanan Pendataan Penduduk Non Permanen',
            'is_aktif' => true,
            'parent_id' => 2, // Parent is "Layanan Non Perizinan"
        ]);

        // create 10 more jenis layanan
        for ($i = 3; $i <= 12; $i++) {
            JenisLayanan::create([
                'nama_jenis_layanan' => 'Jenis Layanan ' . $i,
                'icon_jenis_layanan' => 'icon-child',
                'keterangan' => 'Layanan jenis layanan ' . $i,
                'is_aktif' => true,
                'parent_id' => 2, // Parent is "Layanan Non Perizinan"
            ]);
        }
        

    }
}

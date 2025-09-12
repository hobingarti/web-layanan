<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lingkungan;

class LingkunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Lingkungan::truncate();

        Lingkungan::create([
            'nama' => 'Batujimbar',
            'is_aktif' => '1'
        ]);

        Lingkungan::create([
            'nama' => 'Gulingan',
            'is_aktif' => '1'
        ]);

        Lingkungan::create([
            'nama' => 'Panti',
            'is_aktif' => '1'
        ]);

        Lingkungan::create([
            'nama' => 'Pasekuta',
            'is_aktif' => '1'
        ]);

        Lingkungan::create([
            'nama' => 'Semawang',
            'is_aktif' => '1'
        ]);

        Lingkungan::create([
            'nama' => 'Sindu Kaja',
            'is_aktif' => '1'
        ]);

        Lingkungan::create([
            'nama' => 'Sindu Kelod',
            'is_aktif' => '1'
        ]);

        Lingkungan::create([
            'nama' => 'Singgi',
            'is_aktif' => '1'
        ]);

        Lingkungan::create([
            'nama' => 'Taman',
            'is_aktif' => '1'
        ]);
    }
}

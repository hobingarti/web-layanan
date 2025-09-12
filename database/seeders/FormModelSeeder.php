<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FormModel;

class FormModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FormModel::truncate();
        
        FormModel::create([
            'nama' => 'Buku Mutasi Penduduk',
            'kode' => 'bk-101'
        ]);

        FormModel::create([
            'nama' => 'Buku Harian Peristiwa Kependudukan dan Peristiwa Penting',
            'kode' => 'bk-102'
        ]);

        FormModel::create([
            'nama' => 'Form Silsilah dan Waris',
            'kode' => 'fm-101'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\JenisLayananSeeder;
use Database\Seeders\FormModelSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // (new JenisLayananSeeder)->run();
        // (new LayananSeeder)->run();
        // (new WargaSeeder)->run();
        (new LingkunganSeeder)->run();
        (new FormModelSeeder)->run();
    }
}

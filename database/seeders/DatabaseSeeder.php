<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder yang sudah dibuat
        $this->call([
            KategoriSeeder::class,
            UserSeeder::class,
            ProdukSeeder::class,
        ]);
    }
}

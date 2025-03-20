<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Sedan'],
            ['name' => 'SUV'],
            ['name' => 'MPV'],
            ['name' => 'Hatchback'],
            ['name' => 'Pickup'],
            ['name' => 'Convertible'],
            ['name' => 'Coupe'],
            ['name' => 'Wagon'],
            ['name' => 'Crossover'],
            ['name' => 'Electric'],
            ['name' => 'Hybrid'],
            ['name' => 'Luxury'],
        ];

        foreach ($categories as $category) {
            Kategori::updateOrCreate(['name' => $category['name']], $category);
        }
    }
}

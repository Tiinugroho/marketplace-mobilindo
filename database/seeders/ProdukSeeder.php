<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\User;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        $sellers = User::where('role', 'seller')->get();

        foreach ($sellers as $seller) {
            Produk::create([
                'seller_id' => $seller->id,
                'category_id' => 1,
                'brand' => 'Toyota',
                'model' => 'Avanza',
                'year' => '2020',
                'price' => 200000000,
                'description' => 'Toyota Avanza 2020, mulus terawat.',
                'status' => 'available',
                'image' => 'avanza.jpg'
            ]);

            Produk::create([
                'seller_id' => $seller->id,
                'category_id' => 2,
                'brand' => 'Honda',
                'model' => 'Jazz',
                'year' => '2018',
                'price' => 175000000,
                'description' => 'Honda Jazz 2018, kondisi prima.',
                'status' => 'available',
                'image' => 'jazz.jpg'
            ]);
        }
    }
}

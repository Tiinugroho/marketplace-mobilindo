<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Rofiq Kusnandar',
            'username' => 'rofiqadmin',
            'email' => 'rofiq@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '081234567890',
            'address' => 'Jl. Testing',
            'role' => 'admin'
        ]);

        // Seller
        User::create([
            'name' => 'Ahmad Seller',
            'username' => 'ahmadseller',
            'email' => 'ahmad@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '081234567891',
            'address' => 'Jl. Testing',
            'role' => 'seller'
        ]);

        User::create([
            'name' => 'Suci Seller',
            'username' => 'SuciSeller',
            'email' => 'suci@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '081234567892',
            'address' => 'Jl. Testing',
            'role' => 'seller'
        ]);

        // Client
        User::create([
            'name' => 'Riski Client',
            'username' => 'RiskiClient',
            'email' => 'riski@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '081234567893',
            'address' => 'Jl. Testing',
            'role' => 'client'
        ]);

        User::create([
            'name' => 'Afif Client',
            'username' => 'AfifClient',
            'email' => 'afif@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '081234567894',
            'address' => 'Jl. Testing',
            'role' => 'client'
        ]);
        User::create([
            'name' => 'Bayu Client',
            'username' => 'BayuClient',
            'email' => 'bayu@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '081234567894',
            'address' => 'Jl. Testing',
            'role' => 'client'
        ]);
    }
}


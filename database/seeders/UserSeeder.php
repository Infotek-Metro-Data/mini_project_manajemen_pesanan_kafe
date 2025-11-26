<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin Cafe',
            'email' => 'admin@cafe.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Kasir Cafe',
            'email' => 'kasir@cafe.com',
            'password' => Hash::make('password'),
            'role' => 'kasir',
        ]);

        User::create([
            'name' => 'Pelanggan Cafe',
            'email' => 'pelanggan@cafe.com',
            'password' => Hash::make('password'),
            'role' => 'pelanggan',
        ]);
    }
}

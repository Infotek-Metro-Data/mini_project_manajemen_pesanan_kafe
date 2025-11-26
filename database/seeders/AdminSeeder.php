<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class AdminSeeder extends Seeder {
    public function run() {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@cafe.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);
    }
}

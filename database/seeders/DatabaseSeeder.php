<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['name'=>'Admin','email'=>'admin@cafe.com','password'=>Hash::make('password'),'role'=>'admin']);
        User::create(['name'=>'Kasir','email'=>'kasir@cafe.com','password'=>Hash::make('password'),'role'=>'kasir']);
        User::create(['name'=>'Pelanggan','email'=>'pelanggan@cafe.com','password'=>Hash::make('password'),'role'=>'pelanggan']);

        $cat = Category::create(['name' => 'Kopi']);
        Menu::create(['category_id'=>$cat->id, 'name'=>'Kopi Hitam', 'price'=>10000, 'stock'=>50]);
    }
}
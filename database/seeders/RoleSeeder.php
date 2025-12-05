<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RoleSeeder extends Seeder {
    public function run() {
        DB::table('roles')->insert([
            ['id'=>1,'name'=>'admin'],
            ['id'=>2,'name'=>'kasir'],
            ['id'=>3,'name'=>'pelanggan'],
        ]);
    }
}

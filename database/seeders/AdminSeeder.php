<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'test01',
            'email' => 'test01@example.com',
            'password' => Hash::make('password'),
            'admin_level' => 1,
        ]);
        DB::table('admins')->insert([
            'name' => 'test02',
            'email' => 'test02@example.com',
            'password' => Hash::make('password'),
            'admin_level' => 0,
        ]);
    }
}

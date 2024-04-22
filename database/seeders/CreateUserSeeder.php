<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            'id' => '6574812024',
            'username' => 'superadmin@gmail.com',
            'password' => bcrypt('6574812024'),
            'is_password_change' => 0,

        ]);

        DB::table('user_profile')->insert([
            'user_id' => '6574812024',
            'first_name' => 'superadmin',
            'middle_name' => 'superadmin',
            'last_name' => 'superadmin',
            'email' => 'superadmin',
        ]);
    }
}

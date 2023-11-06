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
                'id' =>'1',
                'name' =>'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin1234'),
            ]);

        DB::table('users')->insert([
            'id' =>'2',
            'name' =>'student',
            'email' => 'student@gmail.com',
            'password' => bcrypt('student1234'),
        ]);

        
    }
}

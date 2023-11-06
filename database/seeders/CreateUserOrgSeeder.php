<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CreateUserOrgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_organization')->insert([
                'student_org_id' =>'1',
                'student_id' =>'2020301072',
                'role_id' =>'1',
                'year_level' =>'4th Year',
            ]);
        DB::table('user_organization')->insert([
                'student_org_id' =>'1',
                'student_id' =>'2020301071',
                'role_id' =>'2',
                'year_level' =>'4th Year',

            ]);
    }
}

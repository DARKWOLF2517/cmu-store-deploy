<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CreateCollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('college')->insert([
            'id' =>'1',
            'college' =>'COA',
            'description' =>'College of Agriculture',
        ]);
        DB::table('college')->insert([
            'id' =>'2',
            'college' =>'CAS',
            'description' =>'College of Arts and Sciences',
        ]);
        DB::table('college')->insert([
            'id' =>'3',
            'college' =>'CBM',
            'description' =>'College of Business Management',
        ]);
        DB::table('college')->insert([
            'id' =>'4',
            'college' =>'COED',
            'description' =>'College of Education',
        ]);
        DB::table('college')->insert([
            'id' =>'5',
            'college' =>'CHE',
            'description' =>'College of Human Ecology',
        ]);
        DB::table('college')->insert([
            'id' =>'6',
            'college' =>'COE',
            'description' =>'College of Engineering',
        ]);
        DB::table('college')->insert([
            'id' =>'7',
            'college' =>'CFES',
            'description' =>'College of Forestry and Environmental Science',
        ]);
        DB::table('college')->insert([
            'id' =>'8',
            'college' =>'CISC',
            'description' =>'College of Information Sciences and Computing',
        ]);
        DB::table('college')->insert([
            'id' =>'9',
            'college' =>'CON',
            'description' =>'College of Nursing',
        ]);
        DB::table('college')->insert([
            'id' =>'10',
            'college' =>'CVM',
            'description' =>'College of Veterinary Medicine',
        ]);
        DB::table('college')->insert([
            'id' =>'11',
            'college' =>'University Wide',
            'description' =>'University Wide Organization',
        ]);
    }
}

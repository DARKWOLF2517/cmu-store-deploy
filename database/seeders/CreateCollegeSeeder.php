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
        ]);
        DB::table('college')->insert([
            'id' =>'2',
            'college' =>'CAS',
        ]);
        DB::table('college')->insert([
            'id' =>'3',
            'college' =>'CBM',
        ]);
        DB::table('college')->insert([
            'id' =>'4',
            'college' =>'COED',
        ]);
        DB::table('college')->insert([
            'id' =>'5',
            'college' =>'CHE',
        ]);
        DB::table('college')->insert([
            'id' =>'6',
            'college' =>'COE',
        ]);
        DB::table('college')->insert([
            'id' =>'7',
            'college' =>'CFES',
        ]);
        DB::table('college')->insert([
            'id' =>'8',
            'college' =>'CISC',
        ]);
        DB::table('college')->insert([
            'id' =>'9',
            'college' =>'CON',
        ]);
        DB::table('college')->insert([
            'id' =>'10',
            'college' =>'CVM',
        ]);
        DB::table('college')->insert([
            'id' =>'11',
            'college' =>'ALL    ',
        ]);
    }
}

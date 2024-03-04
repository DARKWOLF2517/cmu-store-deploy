<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CreateOrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //COLLEGE WIDE
        DB::table('organizations')->insert([
            'name' =>'COASCO',
            'description' =>'College of Agriculture Student Council',
            'college_id' => '1',
        ]);
        DB::table('organizations')->insert([
            'name' =>'CASSCO',
            'description' =>'College of Art and  Sciences Student Council',
            'college_id' => '2',
        ]);
        DB::table('organizations')->insert([
            'name' =>'CBMSCO',
            'description' =>'College of Business and Management Student Council',
            'college_id' => '3',
        ]);
        DB::table('organizations')->insert([
            'name' =>'COEDSCO',
            'description' =>'College of Education Student Council',
            'college_id' => '4',
        ]);
        DB::table('organizations')->insert([
            'name' =>'COHESCO',
            'description' =>'College of Human Ecology Student Council',
            'college_id' => '5',
        ]);
        DB::table('organizations')->insert([
            'name' =>'COESCO',
            'description' =>'College of Engineering Student Council',
            'college_id' => '6',
        ]);
        DB::table('organizations')->insert([
            'name' =>'COFESSCO',
            'description' =>'College of Forestry and Environmental Science Student Council',
            'college_id' => '7',
        ]);
        DB::table('organizations')->insert([
            'name' =>'CSCo',
            'description' =>'College of Information Sciences and Computing Student Council',
            'college_id' => '8',
        ]);
        DB::table('organizations')->insert([
            'name' =>'CONSCO',
            'description' =>'College of Nursing Student Council',
            'college_id' => '9',
        ]);
        DB::table('organizations')->insert([
            'name' =>'CVMSCO',
            'description' =>'College of Vetinary Medicine Student Council',
            'college_id' => '10',
        ]);
        //UNIVERSITY WIDE
        DB::table('organizations')->insert([
            'name' =>'USSCO',
            'description' =>'University Seniors Stundents Council',
            'college_id' => '11',
        ]);
        DB::table('organizations')->insert([
            'name' =>'SSC',
            'description' =>'Supreme Student Council',
            'college_id' => '11',
        ]);
        DB::table('organizations')->insert([
            'name' =>'SC',
            'description' =>'Siglakas Council',
            'college_id' => '11',
        ]);
        DB::table('organizations')->insert([
            'name' =>'Blazer',
            'description' =>'Blazer 2024',
            'college_id' => '11',
        ]);
    }
}

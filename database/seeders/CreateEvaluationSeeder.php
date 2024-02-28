<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CreateEvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('evaluation_form')->insert([
            'id' => '1',
            'evaluation_title' =>'Sample Evaluation Form',
            'evaluation_description' =>'This sample is an example of an Evalutaion Form',
            'org_id' => '1',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CreateEvaluationQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('evaluation_questions')->insert([
            'id' => '1',
            'evaluation_form_id' =>'1',
            'description' =>'Stimulates the interest of the students.',
        ]);
        DB::table('evaluation_questions')->insert([
            'id' => '2',
            'evaluation_form_id' =>'1',
            'description' =>'Provide equal opportunities to all students or participants.',
        ]);
        DB::table('evaluation_questions')->insert([
            'id' => '3',
            'evaluation_form_id' =>'1',
            'description' =>'Enhance the learning experience of the students1',
        ]);
    }
}

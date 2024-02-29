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
        //Total of 13 Questions
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
            'description' =>'Enhance the learning experience of the students',
        ]);
        DB::table('evaluation_questions')->insert([
            'id' => '4',
            'evaluation_form_id' =>'1',
            'description' =>'Help in recognizing and developing students’ inner
            skills such as leadership qualities, creative and
            innovative skills, etc.',
        ]);
        DB::table('evaluation_questions')->insert([
            'id' => '5',
            'evaluation_form_id' =>'1',
            'description' =>'Help in developing richer learning experiences by
            giving the students chance to think in new ways to
            solve a problem or answer a question.',
        ]);
        DB::table('evaluation_questions')->insert([
            'id' => '6',
            'evaluation_form_id' =>'1',
            'description' =>'Satisfy students’ need to take time outs to do more
            than just studying.',
        ]);
        DB::table('evaluation_questions')->insert([
            'id' => '7',
            'evaluation_form_id' =>'1',
            'description' =>'Give students a chance to relax, refresh and
            mingle easily with others.',
        ]);
        DB::table('evaluation_questions')->insert([
            'id' => '8',
            'evaluation_form_id' =>'1',
            'description' =>'Provide opportunity for students to apply learning
            in their practical life.',
        ]);
        DB::table('evaluation_questions')->insert([
            'id' => '9',
            'evaluation_form_id' =>'1',
            'description' =>'Provide opportunity for student to work in team.',
        ]);
        DB::table('evaluation_questions')->insert([
            'id' => '10',
            'evaluation_form_id' =>'1',
            'description' =>'The venue was accessible and comfortable',
        ]);
        DB::table('evaluation_questions')->insert([
            'id' => '11',
            'evaluation_form_id' =>'1',
            'description' =>'Attendance',
        ]);
        DB::table('evaluation_questions')->insert([
            'id' => '12',
            'evaluation_form_id' =>'1',
            'description' =>'Cooperation',
        ]);
        DB::table('evaluation_questions')->insert([
            'id' => '13',
            'evaluation_form_id' =>'1',
            'description' =>'Punctuality',
        ]);
    }
}

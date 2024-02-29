<?php

namespace App\Http\Controllers;

use App\Models\EvaluationAnswer;
use App\Models\EvaluationForm;
use App\Models\EvaluationFormAnswer;
use App\Models\EvaluationFormDetails;
use App\Models\EvaluationOption;
use App\Models\EvaluationQuestion;
use App\Models\Event;
use App\Models\EventEvaluation;
use Illuminate\Http\Request;
use Symfony\Component\Console\Question\Question;

class  EvaluationController extends Controller
{
    // public function GetEvaluationResult($event_id){   
    //     $EvaluationQuestions = EvaluationFormDetails::where('event_id', $event_id )->with(['formQuestions', 'formOptions', 'formAnswers'])->get();
    //     return $EvaluationQuestions->toJson();
    // }

    /////////////////////////
    //NEW EVALUATION FORM///
    ///////////////////////
    public function EvaluationFormSummary($event_id)
    {
        return view('student_organization.student_organization_evaluation_results', ['id' => $event_id]);
    }

    public function EvaluationFormAnswer($event_id)
    {
        $EvaluationAnswer = EvaluationFormAnswer::where([['event_id', $event_id]])->get();
        return response()->json(array("evaluation" => $EvaluationAnswer));
    }


    public function EvaluationAnswer($event_id)
    {
        $EvaluationAnswer = EvaluationForm::with('evaluation_question.evaluation_option', 'evaluation_question.evaluation_answers')
            ->whereHas('evaluation_question.evaluation_answers', function ($query) use ($event_id) {
                $query->where('event_id', $event_id);
            })
            ->get();
        // $EvaluationAnswer = EvaluationForm::with('evaluation_question')->get();    
        return $EvaluationAnswer->toJson();
    }
    public function uploadEvaluationForm(Request $request)
    {
        $evaluation_form = new EvaluationForm([
            'evaluation_title' => $request['title'],
            'evaluation_description' => $request['description'],
            'org_id' => $request['org_id'],
            'is_accept_feedback' => $request['accept_feedback'],
        ]);
        $evaluation_form->save();
        foreach ($request->questions as $question) {
            $questions = new EvaluationQuestion([
                'evaluation_form_id' => $evaluation_form->id,
                'description' => $question['text'],
            ]);
            $questions->save();
            foreach ($question['choices'] as $option) {
                $options = new EvaluationOption([
                    'question_id' => $questions->id,
                    'option' => $option['text'],
                ]);
                $options->save();
            }
        }
        return response()->json(['message' => 'Evaluation Form Added Successfully']);
    }
    public function getEvaluationForm($org_id)
    {
        $events = EvaluationForm::where('org_id', $org_id)->with('evaluation_question.evaluation_option')->get();
        return $events->toJson();
    }
    public function deleteEvaluationForm($evaluation_form_id)
    {
        EvaluationForm::where('id', $evaluation_form_id)->delete();
        return response()->json(['message' => 'Evaluation Form Deleted Successfully']);
    }
    public function store(Request $request, $user_id, $event_id, $feedback)
    {
        //to add the answer in each choices
        foreach ($request->all() as $key => $data) {
            $answer = new EvaluationAnswer();
            $answer->student_id = $user_id;
            $answer->question_id = $key;
            $answer->option_id = $data;
            $answer->event_id = $event_id;
            $answer->save();
        }
        //to input comments feedback if there is
        if ($feedback) {
            $answer = new EvaluationAnswer();
            $answer->student_id = $user_id;
            $answer->event_id = $event_id;
            $answer->word_answer =  $feedback;
            $answer->save();
        }
        return response()->json('Answer Submitted Successfully');
    }
    public function getEvaluationFeedback($event_id)
    {
        $evaluation_feedback = EvaluationAnswer::where('event_id', $event_id)
            ->whereNotNull('word_answer') // Filter records where word_answer is not null
            ->get();
        return $evaluation_feedback->toJson();
    }
    public function getEvents($event_id)
    {
        $event = Event::where('event_id', $event_id)->with('organization')->first();
        return $event->toJson();
    }
    public function getEvaluationFormUpdate($evaluation_id)
    {
        $events = EvaluationForm::where('id', $evaluation_id)->with('evaluation_question.evaluation_option')->first();
        return $events->toJson();
    }
    public function updateEvaluationForm(Request $request)
    {
        // return $request;
        // Update records where 'event_id' equals $event_id and 'other_column' equals $other_value
        EvaluationForm::where('id', $request->evaluation_form_id)
            ->update([
                'evaluation_title' => $request['title'],
                'evaluation_description' => $request['description'],
                'is_accept_feedback' => $request['accept_feedback']
            ]);

        foreach ($request->questions as $question) {
            // return $question['id'];
            EvaluationQuestion::where('id', $question['id'])
                ->update([
                    'description' => $question['text']
                ]);
            foreach ($question['choices'] as $option) {
                EvaluationOption::where('id', $option['id'])
                    ->update([
                        'option' => $option['text']
                    ]);
            }
        }
        return response()->json(['message' => 'Evaluation Form Added Successfully']);
    }

    /////////////////////
    //student section///
    ///////////////////
    public function EvaluationForm($event_id, $evaluation_form)
    {
        return view('student.student_evaluation_form', ['event_id' => $event_id, 'evaluation_form_id' => $evaluation_form]);
    }
    public function EvaluationTotalResponse($event_id)
    {
        $EvaluationCount = EvaluationFormAnswer::where('event_id', $event_id)->count();
        return $EvaluationCount;
    }
    public function EvaluationResultTitle($event_id)
    {
        $events = Event::where('event_id', $event_id)->with('organization')->get();
        return $events->toJson();
    }
    public function isDoneEvaluation($student_id)
    {
        $evaluation = EvaluationAnswer::where([
            ['student_id', $student_id],
        ])->get();

        if ($evaluation->isEmpty()) {

            return "0";
        } else {

            return $evaluation;
        }
    }
    public function getEvaluationList($org_id, $school_year)
    {
        $events = Event::where('org_id', $org_id)->with('organization')->get();
        return $events->toJson();
    }
    public function getEvaluationQuestion($evaluation_form_id)
    {
        $evaluationQuestions = EvaluationForm::where('id', $evaluation_form_id)->with('evaluation_question.evaluation_option')->first();
        return $evaluationQuestions->toJson();
    }
}

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

class EvaluationController extends Controller
{
    // public function GetEvaluationResult($event_id){   
    //     $EvaluationQuestions = EvaluationFormDetails::where('event_id', $event_id )->with(['formQuestions', 'formOptions', 'formAnswers'])->get();
    //     return $EvaluationQuestions->toJson();
    // }
    public function EvaluationFormSummary($event_id)
    {
        return view('student_organization.student_organization_evaluation_results', ['id' => $event_id]);
    }
    public function store(Request $request, $user_id, $event_id)
    {
        // return $request;
        foreach ($request->all() as $data) {
            return $data;
            // $answer = new EvaluationAnswer();
            // $answer->student_id = $data['0'];
            // $answer->question_id = $request['user_id'];
            // $answer->option_id = $request['org_id'];
            // $answer->event_id = $request['org_id'];
            // $answer->save();
        }
        // return redirect()->back()->with('success', 'Evaluation created successfully!');
    }

    public function EvaluationFormAnswer($event_id)
    {
        $EvaluationAnswer = EvaluationFormAnswer::where([['event_id', $event_id]])->get();
        return response()->json(array("evaluation" => $EvaluationAnswer));
    }

    /////////////////////////
    //NEW EVALUATION FORM///
    ///////////////////////
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
        return "success";
    }
    public function getEvaluationForm($org_id)
    {
        $events = EvaluationForm::where('org_id', $org_id)->with('evaluation_question.evaluation_option')->get();
        return $events->toJson();
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
        $evaluation = EvaluationFormAnswer::where([
            ['user_id', $student_id],
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
        $evaluationQuestions = EvaluationQuestion::where('evaluation_form_id', $evaluation_form_id)->with('evaluation_option')->get();
        return $evaluationQuestions->toJson();
    }
}

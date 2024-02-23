<?php

namespace App\Http\Controllers;

use App\Models\EvaluationAnswer;
use App\Models\EvaluationFormAnswer;
use App\Models\EvaluationFormDetails;
use App\Models\Event;
use App\Models\EventEvaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    // public function GetEvaluationResult($event_id){   
    //     $EvaluationQuestions = EvaluationFormDetails::where('event_id', $event_id )->with(['formQuestions', 'formOptions', 'formAnswers'])->get();
    //     return $EvaluationQuestions->toJson();
    // }
    public function EvaluationFormSummary($event_id){ 
        return view('student_organization.student_organization_evaluation_results', ['id' => $event_id]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'event_id' => 'required|exists:events,event_id',
            'user_id' => 'required|exists:users,id',
            'org_id' => 'required|exists:organizations,org_id',
            'q1' => 'required',
            'q2' => 'required',
            'q3' => 'required',
            'q4' => 'required',
            'q5' => 'required',
            'q6' => 'required',
            'q7' => 'required',
            'q8' => 'required',
            'q9' => 'required',
            'q10' => 'required',
            'q11' => 'required',
            'q12' => 'required',
            'q13' => 'required',
            'q14' => 'required',
            'q15' => 'required',
            'q16' => 'required',
            
        ]);
        $answer = new EvaluationFormAnswer();
        $answer->event_id = $validatedData['event_id'];
        $answer->user_id = $validatedData['user_id'];
        $answer->org_id = $validatedData['org_id'];
        $answer->q1 = $validatedData['q1'];
        $answer->q2 = $validatedData['q2'];
        $answer->q3 = $validatedData['q3'];
        $answer->q4 = $validatedData['q4'];
        $answer->q5 = $validatedData['q5'];
        $answer->q6 = $validatedData['q6'];
        $answer->q7 = $validatedData['q7'];
        $answer->q8 = $validatedData['q8'];
        $answer->q9 = $validatedData['q9'];
        $answer->q10 = $validatedData['q10'];
        $answer->q11 = $validatedData['q11'];
        $answer->q12 = $validatedData['q12'];
        $answer->q13 = $validatedData['q13'];
        $answer->q14 = $validatedData['q14'];
        $answer->q15 = $validatedData['q15'];
        $answer->q16 = $validatedData['q16'];
        $answer->save();
        return redirect()->back()->with('success', 'Evaluation created successfully!');
    }
    public function EvaluationFormAnswer($event_id) { 
        $EvaluationAnswer = EvaluationFormAnswer::where([['event_id',$event_id]])->get();  
        return response()->json(array("evaluation"=>$EvaluationAnswer));
    }
    public function EvaluationAnswer($event_id) { 
        $EvaluationAnswer = EventEvaluation::get();  
        return $EvaluationAnswer->toJson();
    }
    
    ////////////////////
    //student section///
    ///////////////////
    public function EvaluationForm($event_id){ 
        return view('student.student_evaluation_form', ['event_id' => $event_id]);
    }
    public function EvaluationTotalResponse($event_id){ 
        $EvaluationCount = EvaluationFormAnswer::where('event_id', $event_id )->count();
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
}

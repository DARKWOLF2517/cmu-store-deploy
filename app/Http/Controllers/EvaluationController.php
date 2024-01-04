<?php

namespace App\Http\Controllers;

use App\Models\EvaluationFormAnswer;
use App\Models\EvaluationFormDetails;
use App\Models\Event;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    //
    
    public function GetEvaluationResult($event_id){   
        $EvaluationQuestions = EvaluationFormDetails::where('event_id', $event_id )->with(['formQuestions', 'formOptions', 'formAnswers'])->get();
        // $EvaluationQuestions = EvaluationFormDetails::all();
        return $EvaluationQuestions->toJson();
        // return ($event_id);
    }
    public function EvaluationFormSummary($event_id){ 
        return view('student_organization.student_organization_evaluation_results', ['id' => $event_id]);
    }

    public function store(Request $request){
        // Validate the form data
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

        // Create a new Event instance
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

        // Redirect or return a response
        return redirect()->back()->with('success', 'Event created successfully!');
    }

    // public function EvaluationFormAnswer($event_id, $question_id, $option){ 
    //     // $EvaluationAnswer = EvaluationFormAnswer::where('evaluation_form_id', $evaluation_form_id )->with(['formQuestions', 'formOptions', 'formAnswers'])->get();
    //     // // $EvaluationQuestions = EvaluationFormDetails::all();  
    //     $EvaluationAnswer = EvaluationFormAnswer::where([
    //         ['event_id',$event_id],
    //         [$question_id, $option]
    //     ])->get();

    //     $EvaluationAnswerCount = $EvaluationAnswer->count();      
    //     return $EvaluationAnswerCount;
    // }

    public function EvaluationFormAnswer($event_id) { 
        $EvaluationAnswer = EvaluationFormAnswer::where([
            ['event_id',$event_id]
        ])->get();  
        return response()->json(array("evaluation"=>$EvaluationAnswer));
    }

    //student section
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
        // $evaluation = EvaluationFormAnswer::where([
        //     ['org_id', $organization_id],
        // ])->get();

        $evaluation = EvaluationFormAnswer::where([
            ['user_id', $student_id],
        ])->get();
        
        if ($evaluation->isEmpty()) {
            
            return "0";
        } else {
            
            return $evaluation;
        }
        
        // Pluck only 'user_id' and 'event_id' columns from the collection
        
        // return $evaluation->toJson();

    }
    public function getEvaluationList($org_id, $school_year)
    {
        $events = Event::where('org_id', $org_id)->with('organization')->get();
        return $events->toJson();

    }
}

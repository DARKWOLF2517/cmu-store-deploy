<?php

namespace App\Http\Controllers;

use App\Models\Accountability;
use App\Models\Attendance;
use App\Models\Event;
use App\Models\EventExempted;
use App\Models\FreeFinesStudent;
use App\Models\OrganizationAccountability;
use App\Models\PaidAccountability;
use App\Models\User;
use App\Models\UserOrganization;
use App\Models\YearLevel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountabilitiesController extends Controller
{
    public function getAccountabilities($org_id)
    {
        $accountabilities = Event::where([['org_id', $org_id ],['require_attendance', 1]])->with(['Attendance'])->get();
        return $accountabilities->toJson();
    }

    public function store(Request $request)
    {
             // Validate the form data
            $validatedData = $this->validate($request,[
                'org_id' => 'required',
                'description' => 'required',
                'amount' => 'required',
                'school_year'=> 'required',
            ]);
    
            // // Create a new Event instance
            $accountability = new Accountability([
                'org_id' => $validatedData['org_id'],
                'accountability_name' => $validatedData['description'],
                'amount' => $validatedData['amount'],
                'school_year' => $validatedData['school_year'],
                
            ]);
            $accountability->save();
    
            // Redirect or return a response
            return response()->json(['message' => 'Accountability Created Successfully']);
            // return $request;
    }
    public function getAccountabilitiesList($org_id, $school_year)
    {
        $accountabilities = Accountability::where([['org_id', $org_id], ['school_year', $school_year]] )->get();
        return $accountabilities->toJson();
    }
    public function AccountabilitiesListInAdmin($org_id,$school_year)
    {
            $accountabilities = Event::where([['org_id', $org_id ],['require_attendance', 1],['school_year', $school_year]])->with(['Attendance'])->get();
            $users = User::all();
            $userOrgs = UserOrganization::all();
            $paidAccountability = PaidAccountability::where([['student_org_id', $org_id ],['school_year', $school_year]])->get();
            $accountability = OrganizationAccountability::where([['org_id', $org_id ],['school_year', $school_year]])->get();
            $yearLevel = YearLevel::where([['org_id', $org_id ]])->get();
            $exempted = EventExempted::where([['org_id', $org_id ],['school_year', $school_year]])->get();
            $freeFines = FreeFinesStudent::where([['org_id', $org_id ],['school_year', $school_year]])->get();
            // return $accountabilities->toJson();
            return response()->json([
                'accountabilities_fines' => $accountabilities, 
                'user' => $users,
                'user_orgs' => $userOrgs,
                'paid_accountabilities' => $paidAccountability, 
                'accountabilities_other' => $accountability,
                'year_level' => $yearLevel,
                'year_level_exempted' => $exempted,
                'free_fines' => $freeFines,

                ]);
    }

    public function updateEventAttendanceStatus($event_id,$status)
    {
        $attendance = Event::find($event_id);
        $attendance->update(['attendance_status' => $status]);
        if ($status == 1){
            $status = 'Ongiong';
        }
        else if ($status == 0){
            $status = 'Stoped';
        }
        
        return response()->json(['message' => 'Attendance Status of '. $attendance -> name .' Changed to '. $status ]);
    }

    public function OtherAccountabilityPayment(Request $request)
    {
             // Validate the form data
            $validatedData = $this->validate($request,[
                'accountability_name' => 'required',
                'amount' => 'required',
                'student_id' => 'required',
                'student_name' => 'required',
                'student_org_id' => 'required',
            ]);
    
            // // Create a new Event instance
            $accountability = new PaidAccountability([
                'student_id' => $validatedData['student_id'],
                'student_org_id' => $validatedData['student_org_id'],
                'accountability_name' => $validatedData['accountability_name'],
                'amount' => $validatedData['amount'],
                
            ]);
            $accountability->save();
    
            // Redirect or return a response
            return response()->json(['message' => 'Accountability Paid Successfully']);
            // return $request;
    }
    public function FinesAccountabilityPayment(Request $request)
    {
             // Validate the form data
            $validatedData = $this->validate($request,[
                'student_id' => 'required',
                'student_org_id' => 'required',
                'accountability_name' => 'required',
                'amount' => 'required',
            ]);
    
            // // Create a new Event instance
            $accountability = new PaidAccountability([
                'student_id' => $validatedData['student_id'],
                'student_org_id' => $validatedData['student_org_id'],
                'accountability_name' => $validatedData['accountability_name'],
                'amount' => $validatedData['amount'],
                
            ]);
            $accountability->save();
    
            // Redirect or return a response
            return response()->json(['message' => 'Accountability Paid Successfully']);
            // return $request;
    }
    public function attendanceFill(Request $request)
    {


            foreach ($request->all() as $data) {
                $attendance = new Attendance([
                    'user_id' => $data['0'],
                    'org_id' => $data['7'],
                    'event_id' => $data['6'],
                    'officer_id' =>$data['8'] ,
                    'session' => $data['5'],
                    'remarks' => 1,
                    
                ]);
                $attendance->save();
                
            }
            return response()->json(['message' => 'Accountability Paid Successfully']);
    
    }
    public function DeleteOrganizationAccountability(OrganizationAccountability $accountability_id)
    {
        $accountability_id->delete();
        return response()->json(['message' => 'Accountability '. $accountability_id-> accountability_name.' Deleted successfully']);
    }
    public function PaidAccountabilities($org_id)
    {
        $paidAccountabilities = PaidAccountability::where('student_org_id', $org_id )->with('user')->get();
        return $paidAccountabilities->toJson();
    }

    public function viewFreeFinesStudents($org_id, $school_year)
    {
        $freeFinesStudents = FreeFinesStudent::where([['org_id', $org_id], ['school_year', $school_year]] )->with('user')->get();
        return $freeFinesStudents->toJson();
    }   
    public function addFreeFinesStudents(Request $request)
    {
        if($this->addFreeFinesRepetition($request['student_id'],$request['school_year']) >= 1)
        {
            return response()->json(array("message"=>"Already in the list","error"=> 1));
        }
             // Validate the form data
            $validatedData = $this->validate($request,[
                'org_id' => 'required',
                'reason' => 'required',
                'school_year' => 'required',
                'student_id' => 'required',
            ]);
    
            // // Create a new free fines instance
            $freeFines = new FreeFinesStudent([
                'student_id' => $validatedData['student_id'],
                'reason' => $validatedData['reason'],
                'org_id' => $validatedData['org_id'],
                'school_year' => $validatedData['school_year'],
                
            ]);
            $freeFines->save();
    
            // Redirect or return a response
            return response()->json(['message' => 'Free Fines Student Added Successfully']);
            // return $request;
    }
    public function addFreeFinesRepetition($student_id, $school_year)
    {
        $student = FreeFinesStudent::where([
            ['student_id', $student_id],
            ['school_year', $school_year]
        ])->get();
        $student = $student->count();
        return $student;
    }
    public function getStudentName($student_id)
    {
        $student = UserOrganization::where([
            ['student_id', $student_id],
        ])->with('user')->first();
        return $student;
    }
    public function deleteStudentFreeFines($student_id)
    {
        // $student_id->delete();
        FreeFinesStudent::where('student_id',$student_id )->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }
    public function fetchUpdateStudentData($student_id)
    {
        $student = FreeFinesStudent::where([
            ['student_id', $student_id],
        ])->with('user')->first();
        return $student;
    }
    public function updateStudentData($student_id, $reason)
    {
        $attendance = FreeFinesStudent::find($student_id);
        $attendance->update(['reason' => $reason]);

    
        return response()->json(['message' => 'Attendance Status of ']);
    }
}

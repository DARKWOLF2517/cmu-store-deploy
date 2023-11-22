<?php

namespace App\Http\Controllers;

use App\Models\Accountability;
use App\Models\Event;
use App\Models\User;
use App\Models\UserOrganization;
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
            ]);
    
            // // Create a new Event instance
            $accountability = new Accountability([
                'org_id' => $validatedData['org_id'],
                'accountability_name' => $validatedData['description'],
                'amount' => $validatedData['amount'],
                
            ]);
            $accountability->save();
    
            // Redirect or return a response
            return response()->json(['message' => 'Accountability Created Successfully']);
            // return $request;
    }
    public function getAccountabilitiesList($org_id)
    {
        $accountabilities = Accountability::where('org_id', $org_id )->get();
        return $accountabilities->toJson();
    }
    public function AccountabilitiesListInAdmin($org_id)
    {

            $accountabilities = Event::where([['org_id', $org_id ],['require_attendance', 1]])->with(['Attendance'])->get();
            $users = User::all();
            // return $accountabilities->toJson();
            return response()->json([
                'accountabilities' => $accountabilities, 
                'user' => $users
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
}

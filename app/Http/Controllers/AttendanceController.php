<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Event;
use App\Models\UserOrganization;

class AttendanceController extends Controller
{
    public function showAttendanceList($event_id, $org_id,$session)
    {
        $attendance = Attendance::where([
            ['event_id', $event_id],
            ['org_id', $org_id],
            ['session', $session],
        ])->get();
        
        return $attendance->toJson();
    }

    public function AttendanceList($organization_id, $event_id)
    {
        $attendance = Attendance::where([
            ['org_id', $organization_id],
            ['event_id', $event_id]
        ])->with(['user','events'])->get();

        return $attendance->toJson();
    }
    public function events($event_id)
    {
        return view('student_organization.student_organization_attendance_record', ['event_id' => $event_id]);
    }

    public function store(Request $request){
        if($this->attendanceRepetition($request['user_id'],$request['session'],$request['event_id']) >= 1)
        {
            return response()->json(array("result"=>"failure","message"=>"Already logged in for this session..."));
        }
        $validatedData = $request->validate([
            'user_id' => 'required',
            'org_id'  => 'required',
            'event_id'  => 'required',
            'officer_id'  => 'required',
            'session'  => 'required',
        ]);
        $attendances = new Attendance();
        $attendances->user_id = $validatedData['user_id'];
        $attendances->org_id = $validatedData['org_id'];
        $attendances->event_id = $validatedData['event_id'];
        $attendances->officer_id = $validatedData['officer_id'];
        $attendances->session = $validatedData['session'];
        $attendances->remarks = 0;
        $attendances->save();

        return response()->json(array("result"=>"success","message"=>"Student successfully logged in..."));
    }

    public function attendanceRepetition($result_id, $session, $event_id)
    {
        $attendance = Attendance::where([
            ['user_id', $result_id],
            ['session', $session],
            ['event_id', $event_id]
        ])->get();
        $attendance = $attendance->count();
        return $attendance;
    }

    public function update($event_id,$status)
    {   
        $attendance = Event::find($event_id);
        $attendance->update(['evaluation_status' => $status]);
        if ($status == 1){
            $status = 'Ongoing';
        }
        else if ($status == 0){
            $status = 'Closed';
        }
        
        return response()->json(['message' => 'Evaluation Status of '. $attendance -> name .' Changed to '. $status ]);

    }
    public function attendanceRecord($organization_id)
    {   
        $attendance = Event::where('org_id', $organization_id)->with('Attendance')->get();
        return $attendance->toJson();

    }
    public function showQR($event_id, $org_id, $session)
    {   

        return view('student_organization.student_organization_qr_scanner', ['event_id' => $event_id, 'org_id' => $org_id, 'session' => $session]);

        
    }
    public function AttendanceCount($event_id, $org_id)
    {   

        $attendance = Event::where([
            ['event_id', $event_id],
            ['org_id', $org_id],
        ])->value('attendance_count');
        return $attendance;

    }
}

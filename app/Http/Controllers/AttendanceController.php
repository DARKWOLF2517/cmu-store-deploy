<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Event;
use App\Models\UserOrganization;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Mail\Attendance as AttendanceMail;
use App\Models\EventAttendanceChecker;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\returnSelf;

class AttendanceController extends Controller
{
    public function showAttendanceList($event_id, $org_id, $session)
    {
        $attendance = Attendance::where([
            ['event_id', $event_id],
            ['org_id', $org_id],
            ['session', $session],
            ['remarks', 0],
        ])->with('user_profile')->get();
        return $attendance->toJson();
    }
    public function AttendanceList($organization_id, $event_id)
    {
        $attendance = Attendance::where([
            ['org_id', $organization_id],
            ['event_id', $event_id],
            ['remarks', 0]
        ])->with(['user_profile.college', 'events', 'attendance_checker'])->get();
        return $attendance->toJson();
    }
    public function events($event_id)
    {
        if (Session::get('role') == 3) {
            return view('attendance_checker.student_attendance_records', ['event_id' => $event_id]);
        } else if (Session::get('role') == 1) {
            return view('student_organization.student_organization_attendance_record', ['event_id' => $event_id]);
        }
    }
    public function store(Request $request)
    {
        // return $request;
        if ($this->attendanceRepetition($request['user_id'], $request['session'], $request['event_id']) >= 1) {
            return response()->json(array("result" => "failure", "message" => "Already logged in for this session..."));
        }
        if ($this->notMemberChecker($request['user_id'], $request['org_id']) < 1) {
            return response()->json(array("result" => "failure", "message" => "Invalid Qr Code"));
        }
        $validatedData = $request->validate([
            'user_id' => 'required',
            'org_id'  => 'required',
            'event_id'  => 'required',
            // 'officer_id'  => 'required',
            'session'  => 'required',
        ]);
        $attendances = new Attendance();
        $attendances->user_id = $validatedData['user_id'];
        $attendances->org_id = $validatedData['org_id'];
        $attendances->event_id = $validatedData['event_id'];
        $attendances->officer_id = Auth::id();
        $attendances->session = $validatedData['session'];
        $attendances->remarks = $request->remarks;
        $attendances->time = Carbon::now()->format('H:i');
        $attendances->save();




        // $event = Event::where('event_id', $request->event_id)->with('organization')->first();
        // $user = UserProfile::where('user_id', $request->user_id)->first();
        // $currentDateTime = Carbon::now();

        // $date = $currentDateTime->format('F j, Y'); // Format date as "Month Day, Year"
        // $time = $currentDateTime->format('g:i A');
        // $details = [
        //     'event_name' => $event->name,
        //     'user_name' => $user->first_name . ' ' . $user->last_name,
        //     'org_name' => $event->organization->description,
        //     'date' => $date,
        //     'time' =>  $time,
        //     'session' => $request->session,
        // ];
        // // return $user;
        // if ($user->email) {
        //     Mail::to($user->email)->send(new AttendanceMail($details));
        // }


        return response()->json(array("result" => "success", "message" => "Student successfully logged in..."));
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
    public function notMemberChecker($result_id, $org_id)
    {
        $memberChecker = UserOrganization::where([
            ['student_id', $result_id],
            ['student_org_id', $org_id]
        ])->get();
        $memberChecker = $memberChecker->count();
        return $memberChecker;
    }
    public function update($event_id, $status)
    {
        $attendance = Event::find($event_id);
        $attendance->update(['evaluation_status' => $status]);
        if ($status == 1) {
            $status = 'Ongoing';
        } else if ($status == 0) {
            $status = 'Closed';
        }
        return response()->json(['message' => 'Evaluation Status of ' . $attendance->name . ' Changed to ' . $status]);
    }
    public function attendanceRecord($organization_id, $school_year)
    {
        $attendance = Event::where('org_id', $organization_id)
            ->where('school_year', $school_year)
            ->with(['Attendance' => function ($query) {
                $query->where('remarks', 0);
            }])->orderByDesc('created_at')
            ->get();
        return $attendance->toJson();
    }
    public function showQR($event_id, $org_id, $session)
    {
        return view('student_organization.student_organization_qr_scanner', ['event_id' => $event_id, 'org_id' => $org_id, 'session' => $session]);
    }
    public function AttendanceCount($event_id, $org_id)
    {
        $attendance = Event::where([['event_id', $event_id], ['org_id', $org_id]])->value('attendance_count');
        return $attendance;
    }
    public function back()
    {
        return Redirect::back();
    }
    public function deleteAttendance($id, $session)
    {
        $userOrg = Attendance::where([['user_id', $id], ['session', $session]]);
        $userOrg->delete();
        return response()->json(['message' => 'Attendance Deleted successfully']);
    }
    public function uploadEventAttendanceChecker($event_id)
    {
        $student_id = Auth::id();

        $student_attendance_checker = EventAttendanceChecker::where([['student_id', $student_id], ['event_id', $event_id]])->count();

        if ($student_attendance_checker == 0) {
            $student = new EventAttendanceChecker();
            $student->event_id = $event_id;
            $student->student_id = $student_id;
            $student->save();
            return response()->json(['message' => 'Success']);
        }
    }
    public function checkAttendanceStatus($event_id)
    {
        $attendanceStatus = Event::where('event_id', $event_id)->first();
        return $attendanceStatus->attendance_status;
    }
    // public function attendanceCheckerCount($event_id)
    // {
    //     $student_attendance_checker = EventAttendanceChecker::where('event_id', $event_id)->count();
    //     return $student_attendance_checker;
    // }
}

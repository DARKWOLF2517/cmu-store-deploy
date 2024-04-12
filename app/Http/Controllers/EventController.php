<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventEvaluation;
use App\Models\EventExempted;
use App\Models\EventExemptedAttendance;
use App\Models\PaidAccountability;
use App\Models\SchoolYear;
use App\Models\User;
use App\Models\UserOrganization;
use App\Models\YearLevel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function showEvents()
    {
        return view('student_organization.student_organization_events');
    }

    public function getEvents($org_id = null, $school_year = null)
    {
        $student = Auth::id();
        $userOrgs = UserOrganization::select('student_org_id')
            ->where([
                ['student_id', $student],
                ['role_id', 2],
                ['school_year', Session::get('school_year')]
            ])

            ->groupBy('student_org_id')
            ->get();

        $orgIds = $userOrgs->pluck('student_org_id')->toArray();

        // return $userOrgs;
        if (!$school_year && !$org_id) {
            $events = Event::with('organization')
                ->orderByDesc('created_at')
                ->whereIn('org_id', $orgIds)
                ->get();

            return $events->toJson();
        } else {
            $events = Event::where([['org_id', $org_id], ['school_year', $school_year]])->with('organization', 'EventAttendanceChecker')->orderByDesc('created_at')->get();
            return $events->toJson();
        }
    }
    public function getEventsAttendance($org_id, $school_year)
    {
        $events = Event::where([['org_id', $org_id], ['attendance_status', 1], ['school_year', $school_year]])->get();
        return $events->toJson();
    }
    public function getEventsForCalendar($org_id, $school_year)
    {
        $events = Event::select(DB::raw('name as title', 'start_date as start'))->get();

        $events = Event::select(('name as title'),
            DB::raw("CONCAT(start_date, 'T', start_attendance) as start")
        )->where([['org_id', $org_id], ['school_year', $school_year]])->get();
        return $events->toJson();
    }
    public function getEventsCount($org_id, $school_year)
    {
        $count = Event::where([['org_id', $org_id], ['school_year', $school_year]])->count();
        return $count;
    }
    public function getMembersCount()
    {
        $userCount = User::count();
        return response()->json(['count' => $userCount]);
    }
    public function store(Request $request)
    {

        // return $request->formData['org_id'];
        // Validate the form data
        // $validatedData = $request->validate([
        //     'formData.name' => 'required',
        //     'formData.start_date' => 'required|date',
        //     'formData.start_attendance' => 'required',
        //     'formData.end_attendance' => 'required',
        //     'formData.location' => 'required',
        //     'formData.description' => 'required',
        //     'formData.require_attendance' => 'nullable|boolean',
        //     'formData.attendance_count' => 'nullable|integer',
        //     'formData.fines' => 'nullable',
        //     'formData.org_id' => 'required|exists:organizations,org_id',
        //     'formData.school_year_input' => 'required',
        //     'formData.require_evaluation' => 'nullable'
        // ]);


        // Create a new Event instance
        $event = new Event();
        $event->name = $request->formData['name'];
        $event->start_date = $request->formData['start_date'];
        $event->start_attendance = $request->formData['start_attendance'];
        $event->end_attendance = $request->formData['end_attendance'];
        $event->location = $request->formData['location'];
        $event->description = $request->formData['description'];
        $event->require_attendance = $request->formData['require_attendance'] ?? 0;
        $event->attendance_status = 0;
        $event->attendance_count = $request->formData['attendance_count'] ?? 1;
        $event->fines = $request->formData['fines'] ?? 0;
        $event->org_id = $request->formData['org_id'];
        $event->school_year = $request->formData['school_year_input'];
        $event->require_evaluation = $request->formData['require_evaluation'];
        $event->save();

        foreach ($request->temporary_evaluation_form as $evaluation) {
            $evaluationform = new EventEvaluation();
            $evaluationform->evaluation_form_id = $evaluation;
            $evaluationform->event_id = $event->event_id;
            $evaluationform->save();
        }
        return response()->json(['message' => 'Event Created successfully']);
    }
    public function showEventDetails($event)
    {
        $events = Event::find($event);
        $event_evaluation = EventEvaluation::where('event_id', $event)->with('evaluation_form')->get();
        // Return both $events and $event_evaluation
        return [
            'events' => $events,
            'event_evaluation' => $event_evaluation,
        ];
    }
    public function update(Request $request, $event)
    {
        // $request->formData->validate([
        //     'name' => 'required',
        //     'start_date' => 'required|date',
        //     'start_attendance' => 'required',
        //     'end_attendance' => 'required',
        //     'location' => 'required',
        //     'description' => 'required',
        //     'require_attendance' => 'nullable|boolean',
        //     'fines' => 'nullable',
        //     'evaluation_form' => 'required'
        // ]);
        // return $request->temporary_evaluation_form;
        $event = Event::findOrFail($event);
        $event->update([
            'name' => $request->formData['name'],
            'start_date' => $request->formData['start_date'],
            'start_attendance' => $request->formData['start_attendance'],
            'end_attendance' => $request->formData['end_attendance'],
            'location' => $request->formData['location'],
            'description' => $request->formData['description'],
            'require_attendance' => $request->formData['require_attendance'],
            'require_evaluation' => $request->formData['require_evaluation'],
            'attendance_count' => $request->formData['attendance_count'],
            'attendance_session_started' => $request->formData['attendance_session_started'],
            'fines' => $request->formData['fines'],
        ]);

        return response()->json(['message' => 'Event updated successfully.']);
        // // Assuming you have an Event model
        EventEvaluation::where('event_id', $event)->delete();

        foreach ($request->temporary_evaluation_form as $evaluation) {
            $evaluationform = new EventEvaluation();
            $evaluationform->evaluation_form_id = $evaluation;
            $evaluationform->event_id = $event;
            $evaluationform->save();
        }
        return response()->json(['message' => 'Event ' . $request->name . ' Updated Successfully']);
    }
    public function destroy($event)
    {
        // $event_list = Attendance::where('event_id', $event)->count();
        // if ($event_list > 0){
        //     return response()->json(['message' => 'Unable to delete event because it has attendance records.', 'status' => 0]);
        // }
        // else {
        //     event::where('event_id',$event)->delete();
        //     return response()->json(['message' => 'Event Deleted successfully' , 'status' => 1]);
        // }

        try {
            $event = Event::findOrFail($event);
            $event->delete();

            return response()->json([
                'message' => 'Event Deleted successfully',
                'status' => 1
            ]);
        } catch (QueryException $e) {
            // Check if the exception is due to a foreign key constraint
            if ($e->errorInfo[1] === 1451) {
                return response()->json([
                    'message' => 'Unable to delete event because it has attendance records.',
                    'status' => 0
                ]);
            }

            // Handle other database errors
            return response()->json([
                'message' => 'Database error: ' . $e->getMessage(),
                'status' => 0
            ]);
        }
    }

    public function getSchoolYear()
    {
        $events = SchoolYear::get();
        return response()->json($events);
    }
    public function getEvaluationList($org_id, $school_year = null)
    {
        $events = event::where([['org_id', $org_id], ['school_year', $school_year]])->with('EvaluationFormAnswer')->orderByDesc('created_at')->get();
        return response()->json($events);
    }

    public function getCompleteEventsCount($org_id, $school_year)
    {
        $accountability_total = PaidAccountability::where([
            ['student_org_id', $org_id],
            ['school_year', $school_year],
            ['remarks', '0']
        ])->sum('amount');

        $accountability_total_with_peso_sign = '₱' . number_format($accountability_total, 2);

        return $accountability_total_with_peso_sign;


        return response()->json($accountability_total);
    }
    public function submitYearLevelExempted($org_id, $year_level, $event_id, Request $request)
    {
        $exemptedData = EventExempted::pluck('year_level_id')->toArray();
        $requestData = array_values($request->all());

        //when adding to list
        $differences_when_adding = array_diff($requestData, $exemptedData);
        if (!empty($differences_when_adding)) {
            foreach ($differences_when_adding as $difference) {
                $exempted = new EventExempted([
                    'org_id' => $org_id,
                    'event_id' => $event_id,
                    'year_level_id' => $difference,
                    'school_year' => $year_level,
                ]);
                $exempted->save();
            }
        }

        //when deleting to list 
        $differences_when_removing = array_diff($exemptedData, $requestData);
        if (!empty($differences_when_removing)) {
            // The arrays have different values
            $exemptedData = EventExempted::whereIn('year_level_id', $differences_when_removing)->delete();
        }
        // return response()->json(['message' => 'Exempted Year Level Updated Successfully']);
    }
    public function getYearLevel($org_id)
    {
        $yearLevel = YearLevel::where('org_id', $org_id)->get();
        return $yearLevel->toJson();
    }
    public function getExempted($org_id, $id)
    {
        $events = EventExempted::where([['org_id', $org_id], ['event_id', $id]])->get();
        return response()->json($events);
    }
    public function updateEventStatus($id, $status)
    {
        if ($status == 2) {
            Event::where('event_id', $id)->update(['attendance_status' => $status]);
        }
        Event::where('event_id', $id)->update(['event_status' => $status]);
        return response()->json(['message' => 'Event Updated Successfully']);
    }

    public function submitCancelAttendanceEvent($event_id, $school_year, $org_id, Request $request)
    {
        // $exemptedData = EventExemptedAttendance::where('event_id',$event_id)->get();
        $exemptedData = EventExemptedAttendance::where('event_id', $event_id)
            ->pluck('session')
            ->toArray();
        $requestData = array_values($request->all());
        $DataExempted = EventExemptedAttendance::where('event_id', $event_id)->get();
        // return $DataExempted;
        if ($DataExempted->count() != 0) {
            // Initialize an array to store the sessions to be added
            $exemptedSessions = [];

            // Iterate through the requestData
            foreach ($requestData as $data) {
                // Check if the session is not exempted for the given event_id
                if (!$DataExempted->contains(function ($exempted) use ($event_id, $data) {
                    return $exempted->event_id == $event_id && $exempted->session == $data;
                })) {
                    // Add the session to the array of sessions to be added
                    $exemptedSessions[] = [
                        'event_id' => $event_id,
                        'session' => $data,
                        'school_year' => $school_year,
                        'org_id' => $org_id,

                    ];
                }
            }

            // Insert the exempted sessions in bulk
            EventExemptedAttendance::insert($exemptedSessions);
        } else {
            foreach ($requestData as $data) {
                $exempted = new EventExemptedAttendance([
                    'event_id' => $event_id,
                    'session' => $data,
                    'school_year' => $school_year,
                    'org_id' => $org_id,
                ]);
                $exempted->save();
            }
        }




        // when deleting to list 
        $differences_when_removing = array_diff($exemptedData, $requestData);
        if (!empty($differences_when_removing)) {
            // The arrays have different values
            $exemptedData = EventExemptedAttendance::where('event_id', $event_id)
                ->whereIn('session', $differences_when_removing)
                ->delete();
        }
        return response()->json(['message' => 'Attendance Cancelled Successfully']);
    }
    public function showCancelledAttendance($event_id)
    {
        $cancelledAttendance = EventExemptedAttendance::where([['event_id', $event_id]])->get();
        return response()->json($cancelledAttendance);
    }

    //STUDENT SIDE
    public function eventStudentDashboard($school_year)
    {


        $student = Auth::id();
        $userOrgs = UserOrganization::select('student_org_id')
            ->where([
                ['student_id', $student],
                ['role_id', 2],
                ['school_year', $school_year]
            ])
            ->groupBy('student_org_id')
            ->get();

        $orgIds = $userOrgs->pluck('student_org_id')->toArray();

        $events = Event::with('organization')
            ->orderByDesc('created_at')
            ->whereIn('org_id', $orgIds)
            ->where('school_year', $school_year)
            ->get();
        return $events->toJson();
        // }
    }

    public function calendarStudentDashboard($school_year)
    {

        $student = Auth::id();
        $userOrgs = UserOrganization::select('student_org_id')
            ->where([
                ['student_id', $student],
                ['role_id', 2],
                ['school_year', $school_year]
            ])
            ->groupBy('student_org_id')
            ->get();

        $orgIds = $userOrgs->pluck('student_org_id')->toArray();

        $events = Event::select(DB::raw('name as title', 'start_date as start'))->get();
        $events = Event::select(('name as title'),
            DB::raw("CONCAT(start_date, 'T', start_attendance) as start")
        )->whereIn('org_id', $orgIds)->where([['school_year', $school_year]])->get();
        return $events->toJson();
    }
}

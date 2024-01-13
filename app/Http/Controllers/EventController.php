<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventExempted;
use App\Models\SchoolYear;
use App\Models\User;
use App\Models\YearLevel;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function showEvents()
    {           
        return view('student_organization.student_organization_events');
    }

    public function getEvents($org_id, $school_year = null)
    {        
        if(!$school_year) {
            $events = Event::where([['org_id', $org_id]])->get();
            return $events->toJson();

        }
        else{
            $events = Event::where([['org_id', $org_id],['school_year',$school_year]])->get();
            return $events->toJson();
        }
    }
    public function getEventsAttendance($org_id,$school_year)
    {
        $events = Event::where([['org_id', $org_id], ['attendance_status', 1],['school_year', $school_year]])->get();
        return $events->toJson();
    }
    public function getEventsForCalendar($org_id, $school_year)
    {
        $events = Event::select(DB::raw('name as title', 'start_date as start'))->get();
        
        $events = Event::select(('name as title'),
                                DB::raw("CONCAT(start_date, 'T', start_attendance) as start"))->where([['org_id', $org_id], ['school_year', $school_year]])->get();
        return $events->toJson();
        // return $org_id;
    }

    public function getEventsCount($org_id, $school_year)
    {   
        $count = Event::where([['org_id',$org_id], ['school_year', $school_year]])->count(); 
        return $count;
        
    }    
    public function getMembersCount()
    {   
        $userCount = User::count();
        return response()->json(['count' => $userCount]);
    }
    /**
     * @param $request
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'start_date' => 'required|date',
            'start_attendance' => 'required',
            'end_attendance' => 'required',
            'location' => 'required',
            'description' => 'required',
            'require_attendance' => 'nullable|boolean',
            'attendance_count' => 'nullable|integer',
            'fines' => 'nullable',
            'org_id' => 'required|exists:organizations,org_id',
            'school_year_input' => 'required',
        ]);

        // Create a new Event instance
        $event = new Event();
        $event->name = $validatedData['name'];
        $event->start_date = $validatedData['start_date'];
        $event->start_attendance = $validatedData['start_attendance'];
        $event->end_attendance = $validatedData['end_attendance'];
        $event->location = $validatedData['location'];
        $event->description = $validatedData['description'];
        $event->require_attendance = $validatedData['require_attendance'] ?? 0;
        $event->attendance_status = 0;
        $event->attendance_count = $validatedData['attendance_count'] ?? 1;
        $event->fines = $validatedData['fines'] ?? 0;
        $event->org_id = $validatedData['org_id'];
        $event->school_year = $validatedData['school_year_input'];
        $event->save();

        // Redirect or return a response
        return response()->json(['message' => 'Event Created successfully']);
        // return $request;
    }

    public function showEventDetails($event)
    {   
        $events = Event::find($event);
        return $events;

    }

    public function update(Request $request, Event $event)
    {   
        $request->validate([
            'name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'start_attendance' => 'required',
            'end_attendance' => 'required',
            'location' => 'required',
            'description' => 'required',
            'require_attendance' => 'nullable|boolean',
            'fines' => 'nullable', 
        
        ]);

        $event->update($request->all());
        
        return response()->json(['message' => 'Event '. $request-> name.' Updated Successfully']);
    }
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Event '. $event-> name.' Deleted successfully']);
    }

    public function getSchoolYear($organization_id)
    {   
        $events = SchoolYear::where('org_id', $organization_id)->get();
        return response()->json($events);
    }
    public function getEvaluationList($org_id, $school_year = null)
    {   
        $events = event::where([['org_id', $org_id],['school_year', $school_year]])->with('EvaluationFormAnswer')->get();
        return response()->json($events);
    }

    public function getCompleteEventsCount($org_id ,$school_year)
    {   
        $events = event::where([['org_id', $org_id],['attendance_status', 2],['school_year', $school_year]])->count();
        return response()->json($events);
    }
    public function submitYearLevelExempted($org_id, $year_level,$event_id, Request $request )
    {   
    

        foreach ($request->all() as $data) {
            $exempted = new EventExempted([
                'org_id' => $org_id,
                'event_id' => $event_id,
                'year_level_id' => $data,
                'school_year' => $year_level,
                
            ]);

            // $validatedData = $this->validate($data,[
            //     'school_year' => 'required',
            // ]);
            $exempted->save();
        }
        return response()->json(['message' => 'Year Level Added Successfully']);
    }
    public function getYearLevel($org_id)
    {
        $yearLevel = YearLevel::where('org_id', $org_id)->get();
        return $yearLevel->toJson();
    }
    public function getExempted($org_id, $id)
    {
        // return 'asdfsdf';
        $events = EventExempted::where([['org_id', $org_id],['event_id', $id]])->get();
        return response()->json($events);
    }
}

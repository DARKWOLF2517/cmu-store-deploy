<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function showEvents()
    {           
        return view('student_organization.student_organization_events');
    }

    public function getEvents($org_id)
    {        
        $events = Event::where([['org_id', $org_id]])->get();
        return $events->toJson();
    }
    public function getEventsAttendance($org_id)
    {
        $events = Event::where([['org_id', $org_id], ['attendance_status', 1]])->get();
        return $events->toJson();
    }
    public function getEventsForCalendar($org_id)
    {
        $events = Event::select(DB::raw('name as title', 'start_date as start', 'end_date as end'))->get();
        
        $events = Event::select(('name as title'),
                                DB::raw("CONCAT(start_date, 'T', start_attendance) as start"),
                                DB::raw("CONCAT(end_date, 'T', end_attendance) as end"))->where('org_id', $org_id)->get();
        return $events->toJson();
        // return $org_id;
    }

    public function getEventsCount($org_id)
    {   
        $count = Event::where('org_id',$org_id)->count(); 
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
            'end_date' => 'required|date',
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
        $event->end_date = $validatedData['end_date'];
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

    public function edit($event_id)
    {   
        $events = Event::find($event_id);
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
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
        // $events = Event::all();
        
        $events = Event::where('org_id', $org_id)->get();
        return $events->toJson();
        // return $org_id;
    }
    public function getEventsForCalendar()
    {
        // $events = Event::select(DB::raw('name as title', 'start_date as start', 'end_date as end'))->get();
        
        $events = Event::select(('name as title'),
                                DB::raw("CONCAT(start_date, 'T', start_attendance) as start"),
                                DB::raw("CONCAT(end_date, 'T', end_attendance) as end"))->get();
        return $events->toJson();
    }

    public function getEventsCount()
    {   
        $count = Event::count(); 
        return response()->json(['count' => $count]);
        
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
            'org_id' => 'required|exists:organizations,org_id',
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
        $event->attendance_count = $validatedData['attendance_count'] ?? 1;
        $event->org_id = $validatedData['org_id'];
        $event->save();

        // Redirect or return a response
        return response()->json(['message' => 'Event Created successfully']);
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
        
        ]);

        $event->update($request->all());
        
        return response()->json(['message' => 'Event Updated Successfully']);
    }
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Event Deleted successfully']);
    }

}

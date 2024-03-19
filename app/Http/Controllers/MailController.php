<?php

namespace App\Http\Controllers;

use App\Mail\Attendance;
use Illuminate\Http\Request;
use App\Mail\WelcomeEmail;
use App\Models\Event;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class MailController extends Controller
{
    public function test()
    {
        Mail::to('jerrichopamisa@gmail.com')->send(new WelcomeEmail());
    }
    public function AttendanceCheck(Request $request)
    {
        $event = Event::where('event_id', $request->event_id)->with('organization')->first();
        $user = UserProfile::where('user_id', $request->user_id)->first();
        $currentDateTime = Carbon::now();

        $date = $currentDateTime->format('F j, Y'); // Format date as "Month Day, Year"
        $time = $currentDateTime->format('g:i A');
        $details = [
            'event_name' => $event->name,
            'user_name' => $user->first_name.' '. $user->last_name,
            'org_name' => $event->organization->description,
            'date' => $date,
            'time' =>  $time,
            'session'=>$request->session,
        ];
        // return $user;
        Mail::to($user->email)->send(new Attendance($details));
    }
}

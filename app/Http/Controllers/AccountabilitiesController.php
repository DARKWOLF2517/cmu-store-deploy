<?php

namespace App\Http\Controllers;

use App\Models\Accountability;
use App\Models\Event;
use Illuminate\Http\Request;

class AccountabilitiesController extends Controller
{
    public function getAccountabilities($org_id)
    {
        $accountabilities = Event::where('org_id', $org_id )->with(['Attendance'])->get();
        return $accountabilities->toJson();
    }

    public function store(Request $request)
    {
             // Validate the form data
            $validatedData = $request->validate([
                'org_id' => 'required',
                'description' => 'required',
                'amount' => 'required',
            ]);
    
            // Create a new Event instance
            $event = new Accountability();
            $event->org_id = $validatedData['org_id'];
            $event->accountability_name = $validatedData['description'];
            $event->amount = $validatedData['amount'];
            $event->save();
    
            // Redirect or return a response
            return response()->json(['message' => 'Accountability Created Successfully']);
            // return $request;
    }
    public function getAccountabilitiesList($org_id)
    {
        $accountabilities = Accountability::where('org_id', $org_id )->get();
        return $accountabilities->toJson();
    }

}

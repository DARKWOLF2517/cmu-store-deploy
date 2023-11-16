<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class AccountabilitiesController extends Controller
{
    public function getAccountabilities($org_id)
    {
        $accountabilities = Event::where('org_id', $org_id )->with(['Attendance'])->get();;
        
        return $accountabilities->toJson();
    }

}

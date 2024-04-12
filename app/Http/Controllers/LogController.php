<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogController extends Controller
{
    //
    public function getLogs()
    {
        $logs = Log::latest()->where('org_id', session()->get('org_id'))->with('user_profile')->get();

        // $eventsWithFormattedDates = $logs->map(function ($logs) {
        //     $logs->created_at = Carbon::parse($logs->created_at)->format('Y-m-d H:i:s');

        //     return $logs;
        // });
        return $logs;
    }
}

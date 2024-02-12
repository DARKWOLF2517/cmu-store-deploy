<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    //
    
    public function getAnnouncement($org_id, $school_year)
    {
        $announcement = Announcement::where([['org_id', $org_id], ['school_year', $school_year]])->get();
        return $announcement->toJson();
    }

    public function addAnnouncement($org_id, $school_year, Request $request)
    {
        // Create a new School Year instance
        $addAnnouncement = new Announcement([
            'org_id' => $org_id,
            'school_year' => $school_year,
            'title' => $request['title'],
            'description' => $request['description'],
            'date' => $request['date'],
            'time' => $request['time'],
        ]);
        $addAnnouncement->save();
        return response()->json(['message' => 'Announcement added Successfully']);

    }
    public function fetchEditAnnouncement($id)
    {
        $announcement = Announcement::where([['id', $id]])->first();
        return $announcement->toJson();
    }
    public function updateAnnouncement(Request $request, Announcement $id)
    {   
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        $id->update($request->all());
        
        return response()->json(['message' => 'Announcement Updated Successfully']);
    }
    public function deleteAnnouncement(Announcement $id)
    {
        $id->delete();
        return response()->json(['message' => 'Announcement Deleted successfully']);
    }

}

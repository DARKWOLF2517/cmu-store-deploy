<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\UserOrganization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function getAnnouncement($org_id, $school_year)
    {

        // if ($org_id == 0) {
        //     $announcement = Announcement::with('organization')->orderByDesc('created_at')->where([['school_year', $school_year]])->get();
        //     return $announcement->toJson();
        // } else {
        $announcement = Announcement::with('organization')->orderByDesc('created_at')->where([['org_id', $org_id], ['school_year', $school_year]])->get();
        return $announcement->toJson();
        // }
    }
    public function addAnnouncement($org_id, $school_year, Request $request)
    {
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


    //STUDENT SIDE
    public function getStudentAnnouncement($school_year)
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

        $announcement = Announcement::with('organization')
            // ->orderByDesc('created_at')
            ->whereIn('org_id', $orgIds)
            ->where('school_year', $school_year)
            ->get();
        return $announcement->toJson();
        // }
    }
}

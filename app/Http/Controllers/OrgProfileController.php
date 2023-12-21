<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;

class OrgProfileController extends Controller
{
    //
    public function addSchoolYear(Request $request)
    {
             // Validate the form data
            $validatedData = $this->validate($request,[
                'school_year' => 'required',
                'org_id' => 'required',
            ]);
    
            // // Create a new School Year instance
            $schoolyear = new SchoolYear([
                'school_year' => $validatedData['school_year'],
                'org_id' => $validatedData['org_id'],
                
            ]);
            $schoolyear->save();
            return response()->json(['message' => 'School Year year added Successfully']);
    
    }
    public function viewSchoolYear($org_id)
    {
        $schoolYear = SchoolYear::where('org_id', $org_id)->get();
        return response()->json($schoolYear);
    
    }
    public function fetchUpdateSchoolYear($id)
    {   
        $schoolYear = SchoolYear::find($id);
        return $schoolYear;

    }

    public function updateSchoolYear($id , Request $request)
    {
        $attendance = SchoolYear::find($id);
        $attendance->update(['school_year' => $request['school_year']]);
        
        return response()->json(['message' => 'School Year Updated Successfully']);

    }
    public function DeleteSchoolYear(SchoolYear $id)
    {
        $id->delete();
        return response()->json(['message' => 'School Year Deleted successfully']);
    }

}

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
}

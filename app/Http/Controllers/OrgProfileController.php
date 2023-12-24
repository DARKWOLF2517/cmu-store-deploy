<?php

namespace App\Http\Controllers;

use App\Models\OrganizationOfficer;
use App\Models\SchoolYear;
use App\Models\UserOrganization;
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
            return response()->json(['message' => 'School Year added Successfully']);
    
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
    public function viewOrgOfficer($org_id)
    {
        $orgOfficer = OrganizationOfficer::where('org_id', $org_id)->with('user')->get();
        return response()->json($orgOfficer);
    
    }
    public function viewUsersOrg($org_id)
    {
        $orgUser = UserOrganization::where('student_org_id', $org_id)->with('user')->get();
        return response()->json($orgUser);
    
    }
    public function addOrgOfficer(Request $request)
    {
             // Validate the form data
            $validatedData = $this->validate($request,[
                'id' => 'required',
                'position' => 'required',
                'org_id' => 'required',
            ]);
    
            // // Create a new School Year instance
            $schoolyear = new OrganizationOfficer([
                'id' => $validatedData['id'],
                'position' => $validatedData['position'],
                'org_id' => $validatedData['org_id'],
                
            ]);
            $schoolyear->save();
            return response()->json(['message' => 'Officer added Successfully']);
    
    }

    public function fetchUpdateOfficer($id, $org_id)
    {   
        $records = OrganizationOfficer::where([
            ['id', $id],
            ['org_id', $org_id]
        ])->get();
        return response()->json($records);

    }

    public function DeleteOfficer(OrganizationOfficer $id)
    {
        $id->delete();
        return response()->json(['message' => 'Officer Deleted successfully']);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\OrganizationOfficer;
use App\Models\Role;
use App\Models\SchoolYear;
use App\Models\UserOrganization;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

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
        if($this->officerRepitition($request['student_id'],$request['org_id']) >= 1)
        {
            return response()->json(['message' => 'Already in the List','type' => 0]);
        }
        else{
            $UserYearLevel = UserOrganization::where('student_id', $request['student_id'])->first();
            // Validate the form data
            $validatedData = $this->validate($request,[
                'student_id' => 'required',
                'position' => 'required',
                'org_id' => 'required',
            ]);
    
            // // Create a new School Year instance
            $schoolyear = new OrganizationOfficer([
                'student_id' => $validatedData['student_id'],
                'position' => $validatedData['position'],
                'org_id' => $validatedData['org_id'],
                'year_level_id' => $UserYearLevel->year_level_id,
                
            ]);
            $schoolyear->save();
            return response()->json(['message' => 'Officer added Successfully','type' => 1]);
        }
        // return $request;
    }
    public function officerRepitition($id, $org_id)
    {
        $records = OrganizationOfficer::where([
            ['student_id', $id],
            ['org_id', $org_id]
        ])->get();
        $count = $records->count();
        return $count;
    }

    public function officerRoleRepitition($id, $org_id, $role_id)
    {
        $records = UserOrganization::where([
            ['student_id', $id],
            ['student_org_id', $org_id],
            ['role_id', $role_id]
        ])->get();
        $count = $records->count();
        return $count;
    }

    public function fetchUpdateOfficer($id)
    {   
        // $records = OrganizationOfficer::where([
        //     ['id', $id],
        // ])->get();
        $officerUpdate = OrganizationOfficer::find($id);
        return response()->json($officerUpdate);

    }

    public function DeleteOfficer(OrganizationOfficer $id)
    {
        $id->delete();
        return response()->json(['message' => 'Officer Deleted successfully']);
    }

    public function viewRoles()
    {
        $roles = Role::all();
        return response()->json($roles);

    }

    public function addOrgOfficerRole(Request $request)
    {
        if($this->officerRoleRepitition($request['student_id'],$request['student_org_id'], $request['role_id']) >= 1)
        {
            return response()->json(['message' => 'Already in the List','type' => 0]);
        }
        else{
            // Validate the form data
            $validatedData = $this->validate($request,[
                'role_id' => 'required',
                'student_id' => 'required',
                'student_org_id' => 'required',
                'year_level_id' => 'required',
            ]);

            // // Create a new School Year instance
            $OrganizationRole = new UserOrganization([
                'student_org_id' => $validatedData['student_org_id'],
                'student_id' => $validatedData['student_id'],
                'role_id' => $validatedData['role_id'],
                'year_level_id' => $validatedData['year_level_id'],
                
            ]);
            $OrganizationRole->save();
            return response()->json(['message' => 'Role added Successfully','type' => 1]);
        }

        // return $request;
    }
    public function viewOfficerRole($org_id)
    {
        // $officerRole = UserOrganization::where('student_org_id', $org_id)->with('role')->get();
        $officerRole = UserOrganization::where('student_org_id', $org_id)->with('role','user')->get();
        // $officerRole = UserOrganization::where('student_org_id', $org_id)
        //       ->with('role', 'user')
        //       ->get();
        return response()->json($officerRole);
    
    }
    public function updateOfficerRole($id, Request $request)
    {
        if($this->officerRoleRepitition($request['student_id'],$request['student_org_id'], $request['role_id']) >= 1)
        {
            return response()->json(['message' => 'Already in the List','type' => 0]);
        }
        else{
            $attendance = UserOrganization::find($id);
            $attendance->update(['role_id' => $request['role_id']]);
            
            return response()->json(['message' => 'Role Edited Successfully','type' => 1]);
    
        }
            
            // return $request;

    }
    public function DeleteOfficerRole(UserOrganization $id)
    {
        $id->delete();
        return response()->json(['message' => 'Role Deleted successfully']);
        // return $id;
    }

}

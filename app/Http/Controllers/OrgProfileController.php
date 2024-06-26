<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\OrganizationDefaultSchoolYear;
use App\Models\OrganizationOfficer;
use App\Models\Role;
use App\Models\SchoolYear;
use App\Models\User;
use App\Models\UserOrganization;
use App\Models\YearLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Session;

class OrgProfileController extends Controller
{
    //
    public function addSchoolYear(Request $request)
    {
        // Validate the form data
        $validatedData = $this->validate($request, [
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
    public function viewSchoolYear()
    {
        $schoolYear = SchoolYear::get();
        return response()->json($schoolYear);
    }
    public function fetchUpdateSchoolYear($id)
    {
        $schoolYear = SchoolYear::find($id);
        return $schoolYear;
    }

    public function updateSchoolYear($id, Request $request)
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
    public function viewOrgOfficer($org_id, $school_year)
    {

        $orgOfficer = OrganizationOfficer::where([['org_id', $org_id], ['school_year', $school_year]])->with('user_profile')->get();
        return response()->json($orgOfficer);
    }
    public function viewUsersOrg($org_id)
    {
        $orgUser = UserOrganization::where('student_org_id', $org_id)->with('user_profile')->get();
        return response()->json($orgUser);
    }
    public function addOrgOfficer(Request $request)
    {
        // return $request;
        if ($this->officerRepitition($request['student_id'], $request['org_id']) >= 1) {
            return response()->json(['message' => 'Already in the List', 'type' => 0]);
        }
        if ($this->UserCheck($request['student_id']) <= 0) {
            return response()->json(['message' => 'User Not Found', 'type' => 2]);
        } else {
            $UserYearLevel = UserOrganization::where('student_id', $request['student_id'])->first();
            // Validate the form data
            $validatedData = $this->validate($request, [
                'student_id' => 'required',
                'position' => 'required',
                'org_id' => 'required',
                'school_year' => 'required',
            ]);
            // // Create a new School Year instance
            $schoolyear = new OrganizationOfficer([
                'student_id' => $validatedData['student_id'],
                'position' => $validatedData['position'],
                'org_id' => $validatedData['org_id'],
                'year_level_id' => $UserYearLevel->year_level_id,
                'school_year' => $validatedData['school_year'],

            ]);
            $schoolyear->save();
            return response()->json(['message' => 'Officer added Successfully', 'type' => 1]);
        }
        // return $request;
    }
    public function officerRepitition($id, $org_id)
    {
        $records = OrganizationOfficer::where([
            ['student_id', $id],
            ['org_id', $org_id],
            ['school_year', Session::get('school_year')]
        ])->count();

        return $records;
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
    public function UserCheck($id)
    {
        $records = UserOrganization::where([
            ['student_id', $id],
        ])->get();
        $count = $records->count();
        return $count;
    }

    public function fetchUpdateOfficer($id)
    {
        // $records = OrganizationOfficer::where([
        //     ['id', $id],
        // ])->get();
        $officerUpdate = OrganizationOfficer::where('id', $id)->with('user_profile')->first();
        return response()->json($officerUpdate);
    }

    public function DeleteOfficer(OrganizationOfficer $id)
    {
        $id->delete();
        return response()->json(['message' => 'Officer Deleted successfully']);
    }

    public function viewRoles()
    {
        // $roles = Role::all();

        $roles = Role::where('role_id', '!=', 2)->get();
        return response()->json($roles);
    }

    public function addOrgOfficerRole(Request $request)
    {
        if ($this->officerRoleRepitition($request['student_id'], $request['student_org_id'], $request['role_id']) >= 1) {
            return response()->json(['message' => 'Already in the List', 'type' => 0]);
        } else {
            // Validate the form data
            $validatedData = $this->validate($request, [
                'role_id' => 'required',
                'student_id' => 'required',
                'student_org_id' => 'required',
                'year_level_id' => 'required',
                'school_year' => 'required',
                // 'college_id' => 'required',
            ]);

            // // Create a new School Year instance
            $OrganizationRole = new UserOrganization([
                'student_org_id' => $validatedData['student_org_id'],
                'student_id' => $validatedData['student_id'],
                'role_id' => $validatedData['role_id'],
                'year_level_id' => $validatedData['year_level_id'],
                'school_year' => $validatedData['school_year'],
                // 'college_id' => $validatedData['college_id'],
            ]);
            $OrganizationRole->save();
            return response()->json(['message' => 'Role added Successfully', 'type' => 1]);
        }

        // return $request;
    }
    public function viewOfficerRole($org_id, $school_year)
    {
        // $officerRole = UserOrganization::where('student_org_id', $org_id)->with('role')->get();
        // $officerRole = UserOrganization::where('student_org_id', $org_id)->with('role','user')->get();
        // $officerRole = UserOrganization::where('student_org_id', $org_id)
        //       ->with('role', 'user')
        //       ->get();
        $officerRole = UserOrganization::where([['student_org_id', $org_id], ['school_year', $school_year]])->with('role', 'user_profile')
            ->whereHas('role', function ($query) {
                $query->where('role_id', '!=', 2);
            })
            ->get();
        return response()->json($officerRole);
    }
    public function updateOfficerRole($id, Request $request)
    {
        if ($this->officerRoleRepitition($request['student_id'], $request['student_org_id'], $request['role_id']) >= 1) {
            return response()->json(['message' => 'Already in the List', 'type' => 0]);
        } else {
            $attendance = UserOrganization::find($id);
            $attendance->update(['role_id' => $request['role_id']]);

            return response()->json(['message' => 'Role Updated Successfully', 'type' => 1]);
        }

        // return $request;

    }
    public function DeleteOfficerRole(UserOrganization $id)
    {
        $id->delete();
        return response()->json(['message' => 'Role Deleted successfully']);
        // return $id;
    }

    public function updateOfficer($id, Request $request)
    {
        $orgOfficer = OrganizationOfficer::find($id);
        $orgOfficer->update(['position' => $request['position']]);
        return response()->json(['message' => 'Officer Updated Successfully']);
    }
    public function viewOrgProfile($org_id)
    {
        $orgProfile = Organization::where('org_id', $org_id)->first();
        return response()->json($orgProfile);
    }

    public function viewOrgTotalMembers($org_id, $school_year)
    {
        $orgTotalMembers = UserOrganization::select('student_id')
            ->where([['student_org_id', $org_id], ['school_year', $school_year], ['role_id', 2]])
            ->distinct()
            ->get();
        $orgTotalMembersCount =  $orgTotalMembers->count();
        return $orgTotalMembersCount;
    }
    public function updateOrgProfileDetails($id, Request $request)
    {

        $orgProfileDetails = Organization::find($id);
        // $filename = $request->getSchemeAndHttpHost().'/'. 'assets/profile_image' .'/'. time() . '.' . $request->picture->extension();
        // $request->picture->move(public_path('/assets/profile_image'), $filename);    
        $orgProfileDetails->update(['description' => $request['description']]);
        // $orgProfileDetails->update(['image' =>$filename]);

        return response()->json(['message' => 'Org Profile Updated Successfully']);



    }
    public function updateOrgProfileImage($id, Request $request)
    {
        // return $request;

        $orgProfileDetails = Organization::find($id);
        $filename = $request->getSchemeAndHttpHost().'/'. 'assets/profile_image_for_organization' .'/'. time() . '.' . $request->picture->extension();
        $request->picture->move(public_path('/assets/profile_image_for_organization'), $filename);    
        // $orgProfileDetails->update(['description' => $request['description']]);
        $orgProfileDetails->update(['image' =>$filename]);

        return response()->json(['message' => 'Org Profile Updated Successfully']);



    }
    public function fetchNameOfficerInput($id, $org_id)
    {
        return
        $officerName = UserOrganization::where([['student_id', $id], ['student_org_id', $org_id]])->with('user_profile')->first();
        if ($officerName) {
            return response()->json($officerName);
        } else {
            return response('1');
        }
    }
    public function fetchYearLevel($org_id)
    {
        $YearLevel = YearLevel::where([['org_id', $org_id]])->get();
        return $YearLevel;
    }

    public function addYearLevel(Request $request)
    {
        // Validate the form data
        $validatedData = $this->validate($request, [
            'org_id' => 'required',
            'year_level' => 'required',
        ]);

        // // Create a new School Year instance
        $YearLevel = new YearLevel([
            'org_id' => $validatedData['org_id'],
            'year_level' => $validatedData['year_level'],

        ]);
        $YearLevel->save();
        return response()->json(['message' => 'School Year added Successfully']);
    }
    public function DeleteYearLevel(YearLevel $id)
    {
        $id->delete();
        return response()->json(['message' => 'Year Level Deleted successfully']);
        // return $id;
    }
    public function yearLevelFetchUpdate($id)
    {
        $YearLevel = YearLevel::find($id);
        return $YearLevel;
    }
    public function updateYearLevel($id, Request $request)
    {
        $updateYearLevel = YearLevel::find($id);
        $updateYearLevel->update(['year_level' => $request['year_level']]);
        return response()->json(['message' => 'Role Updated Successfully']);
    }
    public function orgOfficerCount($org_id, $school_year)
    {
        $orgOfficerCount = OrganizationOfficer::where([['org_id', $org_id], ['school_year', $school_year]])->count();
        return response()->json($orgOfficerCount);
    }
}

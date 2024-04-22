<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Organization;
use App\Models\Role;
use App\Models\SchoolYear;
use App\Models\User;
use App\Models\UserOrganization;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function addSchoolYear(Request $request)
    {
        $schoolyear = new SchoolYear([
            'school_year' => $request['school_year'],
            'semester' => $request['semester'],
        ]);
        $schoolyear->save();
        return response()->json(['message' => 'School Year added Successfully']);
    }
    public function fetchUpdateSchoolYear($id)
    {
        $schoolYear = SchoolYear::find($id);
        return $schoolYear;
    }
    public function updateSchoolYear($id, Request $request)
    {
        $school_year = SchoolYear::find($id);
        $school_year->update([
            'semester' => $request['semester'],
            'school_year' => $request['school_year']
        ]);

        return response()->json(['message' => 'School Year Updated Successfully']);
    }

    public function DeleteSchoolYear(SchoolYear $id)
    {
        $id->delete();
        return response()->json(['message' => 'School Year Deleted successfully']);
    }
    public function addCollege(Request $request)
    {
        $college = new College([
            'college' => $request['college'],
            'description' => $request['description'],
        ]);
        $college->save();
        return response()->json(['message' => 'College Added Successfully']);
    }
    public function fetchCollegeEdit($id)
    {
        $schoolYear = College::find($id);
        return $schoolYear;
    }
    public function updateCollege($id, Request $request)
    {
        $school_year = College::find($id);
        $school_year->update([
            'college' => $request['college'],
            'description' => $request['description']
        ]);

        return response()->json(['message' => 'College Updated Successfully']);
    }

    public function deleteCollege(College $id)
    {
        $id->delete();
        return response()->json(['message' => 'School Year Deleted successfully']);
    }

    public function getOrganization()
    {
        $organization = Organization::get();
        return response()->json($organization);
    }

    public function addOrganization(Request $request)
    {
        $organization = new Organization([
            'name' => $request['name'],
            'description' => $request['description'],
            'college_id' => $request['college_id'],
        ]);
        $organization->save();
        return response()->json(['message' => 'Organization Added Successfully']);
    }

    public function editOrganization($id, Request $request)
    {
        $school_year = Organization::find($id);
        return response()->json($school_year);
    }
    public function updateOrganization($id, Request $request)
    {
        $school_year = Organization::find($id);
        $school_year->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'college_id' => $request['college_id']
        ]);

        return response()->json(['message' => 'College Updated Successfully']);
    }
    public function deleteOrganization(Organization $id)
    {
        $id->delete();
        return response()->json(['message' => 'School Year Deleted successfully']);
    }
    public function getOrganizationAdmins()
    {
        $admins = UserOrganization::with('organization', 'user_profile.college', 'role', 'school_year')->where('role_id', 1)->get();
        return response()->json($admins);
    }
    public function addOrganizationAdmin(Request $request)
    {
        $existingUser = User::where('id', $request['student_id'])->count();
        // return   $existingUser;
        if ($existingUser == 0) {
            // return response()->json(['message' => 'ID number is already existing', 'status' => 'error']);
            $user = new User([
                'id' => $request['student_id'],
                'username' => $request['email'],
                'password' => Hash::make(
                    $request['student_id'],
                )
            ]);
            $user->save();

            $userProfile = new UserProfile([
                'user_id' => $request['student_id'],
                'first_name' => $request['first_name'],
                'middle_name' => $request['middle_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'college_id' => $request['college'],
            ]);
            $userProfile->save();
        }
        $existingUserOrganization = UserOrganization::where([['student_id', $request['student_id']], ['school_year', $request['school_year']], ['student_org_id', $request['organization']], ['role_id', 1]])->first();
        // return $existingUserOrganization;
        if ($existingUserOrganization > 0) {
            return response()->json(['message' => 'User Aready Existing in School Year', 'status' => 'error']);
        }
        $userOrgs = new UserOrganization([
            'student_org_id' => $request['organization'],
            'student_id' => $request['student_id'],
            'role_id' => 1,
            'school_year' => $request['school_year'],

        ]);
        $userOrgs->save();

        return response()->json(['message' => 'Organization Added Successfully']);
    }
    public function editOrganizationAdmin($id)
    {
        $userOrgs = UserOrganization::with('organization', 'user_profile.college', 'role', 'school_year')->where('id', $id)->first();
        return response()->json($userOrgs);
    }
    public function updateOrganizationAdmin($id, Request $request)
    {
        $user_organization = UserOrganization::find($id);
        $user_organization->update([
            'student_org_id' => $request['organization'],
            'school_year' => $request['school_year'],
        ]);

        $user_profile = UserProfile::find($request['student_id']);
        $user_profile->update([
            'first_name' => $request['first_name'],
            'middle_name' => $request['middle_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'college_id' => $request['college'],
        ]);
        $user = User::find($request['student_id']);
        $user->update([
            'username' => $request['email'],
        ]);

        return response()->json(['message' => 'Admin Updated Successfully']);
    }
    public function deleteOrganizationAdmin($id, $student_id)
    {
        $user_organization = UserOrganization::find($id);
        $user_organization->delete();

        // $user_profile = UserProfile::find($student_id);
        // $user_profile->delete();

        // $user = User::find($student_id);
        // $user->delete();

        return response()->json(['message' => 'Admin Deleted successfully']);
    }
    public function getUsers()
    {
        $users = User::with('user_profile.year_level', 'user_profile.college')->where('id', '!=', 6574812024)->get();
        return $users;
    }
    public function UserRepitition($id)
    {
        $records = User::where([
            ['id', $id],
        ])->get();
        $count = $records->count();
        return $count;
    }
    public function addSingleStudent(Request $request)
    {
        // Code that may throw an exception
        if ($this->UserRepitition($request->user_id) >= 1) {
            // return response()->json(['message' =>'Student is already in the list','type' => 0]);
        } else {
            $user = new User();
            $user->id = $request->user_id;
            $user->username = strtolower(str_replace(' ', '', $request->email));
            $user->password = Hash::make($request->user_id);
            $user->save();
        }

        $user_profile = UserProfile::updateOrCreate(
            ['user_id' => $request->user_id],
            [
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name ?? '',
                'last_name' => $request->last_name,
                'email' => $request->email,
                'college_id' => $request->college_id,
                // 'year_level_id' => $request->year_level_id ?? '',
            ]
        );
        // Save the changes
        $user_profile->save();
        return response()->json(['message' => 'User Added Successfully', 'type' => 1]);
    }

    public function addMultipleUser($college_id, Request $request)
    {


        $data = $request->input('data');

        // Code that may throw an exception
        foreach ($data as $row) {
            if ($this->UserRepitition($row[0]) >= 1) {
                // return response()->json(['message' => $row[1] .' is already in the list','type' => 0]);
            } else {
                $user = new User();
                $user->id = $row[0];
                $user->username = strtolower(str_replace(' ', '', $row[4]));
                $user->password = Hash::make($row[0]);
                $user->save();
            }
            $user_profile = UserProfile::updateOrCreate(
                ['user_id' => $row[0]], // Unique identifier
                [
                    'first_name' => $row[1],
                    'middle_name' => $row[2] ?? '',
                    'last_name' => $row[3],
                    'email' => $row[4],
                    'college_id' => $college_id ?? null,
                    // 'year_level_id' => $year_level ?? null
                ]
            );
            // Save the changes
            $user_profile->save();
        }
        return response()->json(['message' => 'Students Added Successfully', 'type' => 1]);
    }


    public function deleteUser($id)
    {
        $user_profile = UserProfile::where('user_id', $id)->first();
        $user_profile->delete();

        $user_profile = User::where('id', $id)->first();
        $user_profile->delete();



        return response()->json(['message' => 'User Deleted successfully']);
    }

    public function editUser($id)
    {
        $user_profile = UserProfile::find($id);
        return response()->json($user_profile);
    }
}

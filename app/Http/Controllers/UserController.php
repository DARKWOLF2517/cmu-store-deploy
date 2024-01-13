<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Organization;
use App\Models\User;
use App\Models\UserOrganization;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
        public function GetMemberList($org_id)
        {
            $memberList = UserOrganization::where([['student_org_id', $org_id],['role_id', 2]])->with(['user','organization'])->get();
            return $memberList->toJson();
        }

        //fetch user profile
        public function getUserOrganization($org_id){
            $organization = Organization::find($org_id);
            return $organization;

        }
        public function getUserProfile($student_id){
            $user_organization = UserOrganization::where('student_id',$student_id)->with(['organization','user','yearLevel'])->get();
                return $user_organization;

        }
        public function UserRepitition($id)
        {
            $records = User::where([
                ['id', $id],
            ])->get();
            $count = $records->count();
            return $count;
        }
    
        public function UserOrgRepitition($id , $org_id, $school_year)
        {
            $records = UserOrganization::where([
                ['student_id', $id],
                ['student_org_id', $org_id],
                ['school_year', $school_year], 

            ])->get();
            $count = $records->count();
            return $count;
        }

        public function store($school_year, $college, $year_level ,Request $request)
        {

            $org_id = Session::get('org_id');
            $data = $request->input('data');


            try {
                // Code that may throw an exception
                foreach ($data as $row) {
                    if($this->UserRepitition($row[0]) >= 1 )
                    {
                        // return response()->json(['message' => $row[1] .' is already in the list','type' => 0]);
                    }
                    else{
                        $user = new User();
                        $user->id = $row[0];
                        $user->name = $row[1] . ' '. $row[2] ;
                        $user->email = strtolower(str_replace(' ', '', $row[1]. $row[0]));
                        $user->password = Hash::make($row[0]);
                        $user->save();
                    }
                }
                foreach ($data as $row) {
                    
                    if($this->UserOrgRepitition($row[0], $org_id, $school_year)  >= 1) 
                    {
                        // return response()->json(['message' => $row[1] .' is already in the list','type' => 0]);
                    }
                    else{
                        $userOrg = new UserOrganization();
                        $userOrg->student_org_id = $org_id;
                        $userOrg->student_id = $row[0];
                        $userOrg->role_id = '2' ;
                        $userOrg->year_level_id = $year_level;
                        $userOrg->school_year = $school_year;
                        $userOrg->college_id = $college;
                        $userOrg->save();
                    }
    
                }
    
                return response()->json(['message' => 'Students Added Successfully','type' => 1]);
                // Optionally, you can return a response indicating success or redirection
            } catch (Exception $e) {
                // Code to handle the exception
                return response()->json(['message' => "An exception occurred: " . $e,'type' => 0]);
            } catch (Error $e) {
                // Code to handle errors (PHP 7 and later)
                return response()->json(['message' => "An error occurred: " . $e,'type' => 0]);
            }

            
        }

        public function showStudents($org_id, $school_year)
        {
            $student_list = UserOrganization::where([
                ['student_org_id', $org_id],
                ['role_id', '2'],
                ['school_year', $school_year],
            ])->with(['yearLevel','user'])
            ->get();
            
            return $student_list->toJson();
            // return $school_year;
        }
        public function showforEdit($student_id)
        {
            $student_list = UserOrganization::where([
                ['student_id', $student_id],
                ['role_id', '2']
            ])->with('user')
            ->get();
            
            return $student_list->toJson();
        }
        public function UpdateData(Request $request)
        {   


            $user = User::find($request->student_id); 
            $user_org = UserOrganization::where('student_id', $request->student_id)->first(); 
            if(!$user) {
            return response()->json(['error' => 'User not found'], 404); 
            }

            // $user->name = $request->name;
            // $user->email = $request->email;
            // $user->save();
            $user_org->year_level = $request->year_level;
            $user_org->save();

            // return $request;
            return 'success';
        }
        public function viewCollege()
        {
            $collegeList = College::all();
            
            return $collegeList->toJson();
        }
}

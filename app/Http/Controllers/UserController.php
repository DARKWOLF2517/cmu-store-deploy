<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use App\Models\UserOrganization;
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
            $user_organization = UserOrganization::where('student_id',$student_id)->with(['organization','user'])->get();
                return $user_organization;

        }


        public function store(Request $request)
        {
            $org_id = Session::get('org_id');
            $data = $request->input('data');
            foreach ($data as $row) {
                
         
                
                $user = new User();
                $user->id = $row[0];
                $user->name = $row[3].' '.$row[2].' '.$row[1];

                $row[1] = strtolower(preg_replace('/\s+/', '', $row[1]));
                $row[2] = strtolower(preg_replace('/\s+/', '', $row[2]));
                $row[3] = strtolower(preg_replace('/\s+/', '', $row[3]));       


                $user->email = $row[1].$row[3];
                $user->password = Hash::make($row[0]);
                $user->save();

            }

            foreach ($data as $row) {


                $user = new UserOrganization();
                $user->student_org_id = $org_id;
                $user->student_id = $row[0];
                $user->role_id = '2' ;
                $user->year_level = $row[5];
                $user->save();

            }

            return "Data inserted successfully!";
            // Optionally, you can return a response indicating success or redirection
            // return $request;
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
}

<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\OrganizationDefaultSchoolYear;
use App\Models\Role;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\UserOrganization;
use Illuminate\Contracts\Session\Session;
use PhpParser\Node\Stmt\Return_;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $userOrganizationCount = UserOrganization::where('student_id', Auth::id())->count();
            //if the user has MANY org or role
            if ($userOrganizationCount > 1){
                //tells when there is many user

                session(['many_user' =>  'true']);
                return '4';
            }
            else{
                //if the user has only ONE org or role
                $userOrganization = UserOrganization::where('student_id', Auth::id())->with('organization')->first();
                if($userOrganization){
                    //get org default school year
                    $orgDefaultSchoolYear = OrganizationDefaultSchoolYear::where('org_id',$userOrganization->student_org_id)->count();
                    if($orgDefaultSchoolYear > 0){
                        $orgSchoolYear = OrganizationDefaultSchoolYear::where('org_id',$userOrganization->student_org_id)->first();
                        if ($userOrganization->school_year == $orgSchoolYear->school_year){
                            session(['school_year' =>  $orgSchoolYear->school_year]);
                            session(['org_id' =>  $userOrganization->student_org_id]);
                            session(['org_name' =>  $userOrganization->organization->name]);
                            session(['role' =>  $userOrganization->role_id]);
                            session(['college_id' =>  $userOrganization->college_id]);
                            //tells when there is only one user
                            session(['many_user' =>  'false']);
                            if($userOrganization->role_id == 1){
                                //for admin role when the user has 1 role
                                return '1';
                            }
                            else if($userOrganization->role_id == 2){
                                //for student role when the user has 1 role
                                return '2';
                            }
                            else if($userOrganization->role_id == 3){
                                //for attendance checker role when the user has 1 role
                                return '3';
                            }
                        }
                         //if the user is admin it will bypass the school year
                        else if ($userOrganization->role_id == 1){
                            session(['school_year' =>  $orgSchoolYear->school_year]);
                            session(['org_id' =>  $userOrganization->student_org_id]);
                            session(['org_name' =>  $userOrganization->organization->name]);
                            session(['role' =>  $userOrganization->role_id]);
                            session(['college_id' =>  $userOrganization->college_id]);
                            // return $userOrganization->school_year;
                            return $userOrganization->role_id;
                        }
                        else{
                            return 'not_tagged_error';
                        }
                    }
                    //if the user is admin it will bypass if there is null organization default school year
                    else if ($userOrganization->role_id == 1){
                        session(['school_year' =>  0]);
                        session(['org_id' =>  $userOrganization->student_org_id]);
                        session(['org_name' =>  $userOrganization->organization->name]);
                        session(['role' =>  $userOrganization->role_id]);
                        session(['college_id' =>  $userOrganization->college_id]);
                        // return $userOrganization->school_year;
                        return $userOrganization->role_id;
                    }
                    else{
                        return 'not_tagged_error';
                    }
                }
                else{
                        return 'not_tagged_error';
                    }
                    
            }
            
        }
        else{
            return 'user_creadential_error';
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function GetOrganizationList($student_id)
    {   
        $userOrganizations = UserOrganization::where('student_id', $student_id)->with(['organization','role'])->get();
        return $userOrganizations->toJson();
    }

    public function LoginOrganization($id)
    {   
        // return $id;
        // $userOrganization = UserOrganization::where('id',$id)->with('organization')->first();
        // if($userOrganization){
        //     //get org default school year
        //     $orgDefaultSchoolYear = OrganizationDefaultSchoolYear::where('org_id',$org_id)->count();
        //     $orgSchoolYear = OrganizationDefaultSchoolYear::where('org_id',$org_id)->first();
        //     if($orgDefaultSchoolYear > 0){
        //         if ($userOrganization->school_year == $orgSchoolYear->school_year){
        //             $orgDefaultSchoolYear = OrganizationDefaultSchoolYear::where('org_id',$userOrganization->student_org_id)->first();
        //             session(['school_year' =>  $orgDefaultSchoolYear->school_year]);
        //             session(['org_id' =>  $userOrganization->student_org_id]);
        //             session(['org_name' =>  $organization_name]);
        //             return $role_id;
        //         }
        //         else{
        //             return 'not_tagged_error';
        //         }
        //     }
        //     else{
        //         return 'not_tagged_error';
        //     }
        // }
        // else{
        //         return 'not_tagged_error';
        //     }
        //get latest school year

        $userOrganization = UserOrganization::where('id', $id)->with('organization')->first();
        $orgDefaultSchoolYear = OrganizationDefaultSchoolYear::where('org_id',$userOrganization->student_org_id)->count();
        if($orgDefaultSchoolYear > 0){
            $orgSchoolYear = OrganizationDefaultSchoolYear::where('org_id',$userOrganization->student_org_id)->first();
            if ($userOrganization->school_year == $orgSchoolYear->school_year){
                session(['school_year' =>  $orgSchoolYear->school_year]);
                session(['org_id' =>  $userOrganization->student_org_id]);
                session(['org_name' =>  $userOrganization->organization->name]);
                session(['role' =>  $userOrganization->role_id]);
                session(['college_id' =>  $userOrganization->college_id]);
                // return $userOrganization->school_year;
                return $userOrganization->role_id;
            }
            //if the user is admin it will bypass the school year
            else if ($userOrganization->role_id == 1){
                session(['school_year' =>  $orgSchoolYear->school_year]);
                session(['org_id' =>  $userOrganization->student_org_id]);
                session(['org_name' =>  $userOrganization->organization->name]);
                session(['role' =>  $userOrganization->role_id]);
                session(['college_id' =>  $userOrganization->college_id]);
                // return $userOrganization->school_year;
                return $userOrganization->role_id;
            }
            else{
                return 'not_tagged_error';
            }
        }
        //if the user is admin it will bypass if there is null organization default school year
        else if ($userOrganization->role_id == 1){
            session(['school_year' =>  0]);
            session(['org_id' =>  $userOrganization->student_org_id]);
            session(['org_name' =>  $userOrganization->organization->name]);
            session(['role' =>  $userOrganization->role_id]);
            session(['college_id' =>  $userOrganization->college_id]);
            // return $userOrganization->school_year;
            return $userOrganization->role_id;
        }
        else{
            return 'not_tagged_errors';
        }
    }

    public function LoginDashboard()
    {   
        return redirect()->route('org_dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');

    }

    public function doesExist(int $id)
    {
        // Logic Here
    }

    public function uploadStudents(Request $data)
    {
        //Register User Logic  
        // foreach($data as $student)
        // {
        //     if(!doesExist($student->id))
        //     {

        //     };
        // }
    }
}

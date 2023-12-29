<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\UserOrganization;
use Illuminate\Contracts\Session\Session;


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
            $student_id = Auth::id();

            $userOrganizationCount = UserOrganization::where('student_id', $student_id)->count();
            //if the user has MANY org or role
            if ($userOrganizationCount > 1){
                //tells when there is many user
                session(['many_user' =>  'true']);
                return '4';

                
            }
            else{
                //if the user has only ONE org or role
                $userOrganization = UserOrganization::where('student_id', Auth::id())->with('organization')->first();
                session(['org_id' =>  $userOrganization->student_org_id]);
                session(['org_name' =>  $userOrganization->organization->name]);
                
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
                else{
                    return 'no';
                }
            }
            
        }
        else{
            return 'error';
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

    public function LoginOrganization($org_id, $role_id, $organization_name)
    {   
        session(['org_id' =>  $org_id]);
        session(['org_name' =>  $organization_name]);
        return $role_id;
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

<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organization;
use App\Models\OrganizationDefaultSchoolYear;
use App\Models\Role;
use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\UserOrganization;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Return_;

class LoginController extends Controller
{

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $userOrganizationCount = UserOrganization::where('student_id', Auth::id())->count();
            $defaultSchoolYear = SchoolYear::latest()->first();
            // return $defaultSchoolYear;

            //if the user has MANY role in  organization
            if ($userOrganizationCount > 1) {

                //tells when there is many user
                session(['many_user' =>  'false']);
                //filter if the user has the same org
                $userOrgRoles = UserOrganization::select(DB::raw('COUNT(*) as count'))
                    ->where('student_id', Auth::id())
                    ->groupBy('student_org_id')
                    ->havingRaw('COUNT(*) > 1')
                    ->pluck('count')
                    ->first();
                // if($userOrgRoles > 1 ){

                //if the user has many organization and 2 or more roles on the said organization
                if ($userOrganizationCount != $userOrgRoles) {

                    // Retrieve user organizations with the specified student ID and eager load user_profile
                    $userOrganization = UserOrganization::where('student_id', Auth::id())
                        ->with(['organization', 'user_profile'])
                        ->get();
                    // Check if all user organizations have role_id equal to 2
                    $allHaveRoleIdTwo = $userOrganization->every(function ($userOrganization) {
                        return $userOrganization->role_id == 2;
                    });

                    // All user organizations have role_id equal to 2
                    if ($allHaveRoleIdTwo) {

                        session(['many_user' =>  'false']);
                        $userOrganizations = UserOrganization::where('student_id', Auth::id())
                            ->with(['organization', 'user_profile'])
                            ->first();
                        session(['school_year' =>  $defaultSchoolYear->id]);
                        session(['org_id' =>  $userOrganizations->student_org_id]);
                        session(['org_name' =>  $userOrganizations->organization->name]);
                        session(['role' =>  $userOrganizations->role_id]);
                        session(['user_name' =>  $userOrganizations->user_profile->first_name]);
                        session(['profile_picture' =>  $userOrganizations->user_profile->image]);
                        session(['user_school_year' =>  $userOrganizations->school_year]);
                        // session(['college_id' =>  $userOrganizations->college_id]);
                        // return $userOrganization->school_year;
                        if (Auth::user()->is_password_change == 0) {
                            return 'changepassword';
                        } else {
                            return '2';
                        }
                    }
                    // Not all user organizations have role_id equal to 2
                    else {

                        //if the role has only 1 admin
                        $countOfRoles1 = $userOrganization->where('role_id', 1)->count();
                        $countOfRoles3 = $userOrganization->where('role_id', 3)->count();

                        if ($countOfRoles1 > 0) {
                            // check if there is 2 or more organization that the user is admin
                            $groupedOrganizations = $userOrganization->where('role_id', 1)->groupBy('organization.org_id');

                            // if the user has 2 or more organization with admin role
                            if ($groupedOrganizations->count() > 1) {
                                session(['many_user' =>  'true']);
                                $userOrganization = UserOrganization::where('student_id', Auth::id())->with(['organization', 'user_profile'])->first();
                                session(['user_name' =>  $userOrganization->user_profile->first_name]);
                                session(['school_year' =>  $defaultSchoolYear->id]);
                                session(['profile_picture' =>  $userOrganization->user_profile->image]);
                                if (Auth::user()->is_password_change == 0) {
                                    return 'changepassword';
                                } else {
                                    return '4';
                                }

                                //if the user has 1 organization with admin role
                            } else {

                                $orgName = $userOrganization->where('role_id', 1)->sortByDesc('id')->first();
                                session(['school_year' =>  $defaultSchoolYear->id]);
                                session(['org_id' =>  $orgName->student_org_id]);
                                session(['org_name' =>  $orgName->organization->name]);
                                session(['role' =>  $orgName->role_id]);
                                session(['user_name' =>  $orgName->user_profile->first_name]);
                                session(['profile_picture' =>  $orgName->user_profile->image]);
                                session(['user_school_year' =>  $orgName->school_year]);
                                if (Auth::user()->is_password_change == 0) {
                                    return 'changepassword';
                                } else {
                                    return '1';
                                }
                            }
                        } else if ($countOfRoles3  > 1) {

                            $groupedOrganizations = $userOrganization->where('role_id', 3)->groupBy('organization.org_id');

                            // if the user has 2 or more organization with admin role
                            if ($groupedOrganizations->count() > 0) {

                                session(['many_user' =>  'true']);
                                $userOrganization = UserOrganization::where('student_id', Auth::id())->with(['organization', 'user_profile'])->first();
                                session(['user_name' =>  $userOrganization->user_profile->first_name]);
                                session(['school_year' =>  $defaultSchoolYear->id]);
                                session(['profile_picture' =>  $userOrganization->user_profile->image]);
                                if (Auth::user()->is_password_change == 0) {
                                    return 'changepassword';
                                } else {
                                    return '4';
                                }

                                //if the user has 1 organization with admin role
                            } else {
                                $orgName = $userOrganization->where('role_id', 1)->latest()->first();
                                session(['school_year' =>  $defaultSchoolYear->id]);
                                session(['org_id' =>  $orgName->student_org_id]);
                                session(['org_name' =>  $orgName->organization->name]);
                                session(['role' =>  $orgName->role_id]);
                                session(['user_name' =>  $orgName->user_profile->first_name]);
                                session(['profile_picture' =>  $orgName->user_profile->image]);
                                session(['user_school_year' =>  $orgName->school_year]);
                                if (Auth::user()->is_password_change == 0) {
                                    return 'changepassword';
                                } else {
                                    return '3';
                                }
                            }
                        }
                        // else {
                        //     session(['many_user' =>  'true']);
                        //     $userOrganization = UserOrganization::where('student_id', Auth::id())->with(['organization', 'user_profile'])->first();
                        //     session(['user_name' =>  $userOrganization->user_profile->first_name]);
                        //     session(['school_year' =>  $defaultSchoolYear->id]);
                        //     session(['profile_picture' =>  $userOrganization->user_profile->image]);
                        //     if (Auth::user()->is_password_change == 0) {
                        //         return 'changepassword';
                        //     } else {
                        //         return '4';
                        //     }
                        // }
                    }
                }

                //if the user has one organization and 2 or more roles on the said organization
                else {
                    $userOrganization = UserOrganization::where('student_id', Auth::id())->with(['organization', 'user_profile'])->get();
                    //if the user is admin
                    foreach ($userOrganization as $userOrganizations) {
                        // return $userOrganizations;
                        //filter role admin
                        if ($userOrganizations->role_id == 1) {
                            //   return $userOrganizations->student_org_id;
                            // $orgSchoolYear = OrganizationDefaultSchoolYear::where('org_id',$userOrganizations->student_org_id)->first();
                            session(['school_year' =>  $defaultSchoolYear->id]);
                            session(['org_id' =>  $userOrganizations->student_org_id]);
                            session(['org_name' =>  $userOrganizations->organization->name]);
                            session(['role' =>  $userOrganizations->role_id]);
                            session(['user_name' =>  $userOrganizations->user_profile->first_name]);
                            session(['profile_picture' =>  $userOrganizations->user_profile->image]);
                            session(['user_school_year' =>  $userOrganizations->school_year]);
                            // session(['college_id' =>  $userOrganizations->college_id]);
                            // return $userOrganization->school_year;
                            if (Auth::user()->is_password_change == 0) {
                                return 'changepassword';
                            } else {
                                return '1';
                            }
                        }
                    }
                    foreach ($userOrganization as $userOrganizations) {
                        // return $userOrganizations;
                        //filter the role attendance checker
                        if ($userOrganizations->role_id == 3) {
                            //   return $userOrganizations->student_org_id;
                            // $orgSchoolYear = OrganizationDefaultSchoolYear::where('org_id',$userOrganizations->student_org_id)->first();
                            session(['school_year' =>  $defaultSchoolYear->id]);
                            session(['org_id' =>  $userOrganizations->student_org_id]);
                            session(['org_name' =>  $userOrganizations->organization->name]);
                            session(['role' =>  $userOrganizations->role_id]);
                            session(['user_name' =>  $userOrganizations->user_profile->first_name]);
                            session(['profile_picture' =>  $userOrganizations->user_profile->image]);
                            session(['user_school_year' =>  $userOrganizations->school_year]);
                            // session(['college_id' =>  $userOrganizations->college_id]);
                            // return $userOrganization->school_year;
                            if (Auth::user()->is_password_change == 0) {
                                return 'changepassword';
                            } else {
                                return '3';
                            }
                        }
                    }
                    foreach ($userOrganization as $userOrganizations) {
                        // return $userOrganizations;
                        //filter the role is student
                        if ($userOrganizations->role_id == 2 && $defaultSchoolYear->id == $userOrganizations->school_year) {
                            //   return $userOrganizations->student_org_id;
                            // $orgSchoolYear = OrganizationDefaultSchoolYear::where('org_id',$userOrganizations->student_org_id)->first();
                            session(['school_year' =>  $defaultSchoolYear->id]);
                            session(['org_id' =>  $userOrganizations->student_org_id]);
                            session(['org_name' =>  $userOrganizations->organization->name]);
                            session(['role' =>  $userOrganizations->role_id]);
                            session(['user_name' =>  $userOrganizations->user_profile->first_name]);
                            session(['profile_picture' =>  $userOrganizations->user_profile->image]);
                            session(['user_school_year' =>  $userOrganizations->school_year]);
                            // session(['college_id' =>  $userOrganizations->college_id]);
                            // return $userOrganization->school_year;

                            if (Auth::user()->is_password_change == 0) {
                                return 'changepassword';
                            } else {
                                return '2';
                            }
                        }
                    }
                }
                // }
                // else{
                //     return '4';
                // }

            } else {
                //if the user has only ONE org or role
                $userOrganization = UserOrganization::where('student_id', Auth::id())->with('organization', 'user_profile')->first();
                if ($userOrganization->role_id == 4) {
                    session(['role' =>  $userOrganization->role_id]);
                    session(['user_name' =>  $userOrganization->user_profile->first_name]);
                    session(['profile_picture' =>  $userOrganization->user_profile->image]);
                    //for student role when the user has 1 role
                    if (Auth::user()->is_password_change == 0) {
                        return 'changepassword';
                    } else {
                        return '5';
                    }
                }
                if ($userOrganization) {
                    //get org default school year
                    // $orgDefaultSchoolYear = OrganizationDefaultSchoolYear::where('org_id',$userOrganization->student_org_id)->count();
                    // if($orgDefaultSchoolYear > 0){
                    // $orgSchoolYear = OrganizationDefaultSchoolYear::where('org_id',$userOrganization->student_org_id)->first();
                    // if ($userOrganization->school_year == $defaultSchoolYear->id){
                    session(['school_year' =>  $defaultSchoolYear->id]);
                    session(['org_id' =>  $userOrganization->student_org_id]);
                    session(['org_name' =>  $userOrganization->organization->name]);
                    session(['role' =>  $userOrganization->role_id]);
                    session(['user_name' =>  $userOrganization->user_profile->first_name]);
                    session(['profile_picture' =>  $userOrganization->user_profile->image]);
                    session(['user_school_year' =>  $userOrganization->school_year]);
                    // session(['college_id' =>  $userOrganization->college_id]);
                    //tells when there is only one user
                    session(['many_user' =>  'false']);

                    if ($userOrganization->role_id == 1) {
                        //for admin role when the user has 1 role
                        if (Auth::user()->is_password_change == 0) {
                            return 'changepassword';
                        } else {
                            return '1';
                        }
                    } else if ($userOrganization->role_id == 3) {
                        //for attendance checker role when the user has 1 role
                        if (Auth::user()->is_password_change == 0) {
                            return 'changepassword';
                        } else {
                            return '3';
                        }
                    } else if ($userOrganization->role_id == 2) {
                        //for student role when the user has 1 role
                        if (Auth::user()->is_password_change == 0) {
                            return 'changepassword';
                        } else {
                            return '2';
                        }
                    }

                    // }
                    //  //if the user is admin it will bypass the school year
                    // else if ($userOrganization->role_id == 1){
                    //     session(['school_year' =>  $defaultSchoolYear->id]);
                    //     session(['org_id' =>  $userOrganization->student_org_id]);
                    //     session(['org_name' =>  $userOrganization->organization->name]);
                    //     session(['role' =>  $userOrganization->role_id]);
                    //     session(['user_name' =>  $userOrganization->user_profile->first_name]);
                    //     // session(['college_id' =>  $userOrganization->college_id]);
                    //     // return $userOrganization->school_year;
                    //     return $userOrganization->role_id;
                    // }
                    // else{
                    //     return 'not_tagged_error';
                    // }
                    // }
                    // //if the user is admin it will bypass if there is null organization default school year
                    // else if ($userOrganization->role_id == 1){
                    //     session(['school_year' =>  0]);
                    //     session(['org_id' =>  $userOrganization->student_org_id]);
                    //     session(['org_name' =>  $userOrganization->organization->name]);
                    //     session(['role' =>  $userOrganization->role_id]);
                    //     session(['user_name' =>  $userOrganization->user_profile->first_name]);
                    //     // session(['college_id' =>  $userOrganization->college_id]);
                    //     // return $userOrganization->school_year;
                    //     return $userOrganization->role_id;
                    // }
                    // else{
                    //     return 'not_tagged_error';
                    // }
                } else {
                    return 'not_tagged_error';
                }
            }
        } else {
            return 'user_creadential_error';
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function GetOrganizationList($student_id)
    {


        // $school_year = Session::get('school_year');
        $userOrganizations = UserOrganization::where([['student_id', $student_id]])->with(['organization', 'role'])->get();
        return $userOrganizations->toJson();
    }

    public function LoginOrganization($id)
    {


        $userOrganization = UserOrganization::where('id', $id)
            ->orderBy('id', 'desc')
            ->with('organization', 'user_profile')
            ->first();
        // return $userOrganization;
        // $orgDefaultSchoolYear = OrganizationDefaultSchoolYear::where('org_id',$userOrganization->student_org_id)->count();
        // if($orgDefaultSchoolYear > 0){
        // $orgSchoolYear = OrganizationDefaultSchoolYear::where('org_id',$userOrganization->student_org_id)->first();
        $defaultSchoolYear = SchoolYear::latest()->first();

        // if ($userOrganization->school_year == $defaultSchoolYear->school_year){
        //     session(['school_year' =>  $orgSchoolYear->school_year]);
        //     session(['org_id' =>  $userOrganization->student_org_id]);
        //     session(['org_name' =>  $userOrganization->organization->name]);
        //     session(['role' =>  $userOrganization->role_id]);
        //     session(['user_name' =>  $userOrganization->user_profile->first_name]);
        //     // session(['college_id' =>  $userOrganization->college_id]);
        //     // return $userOrganization->school_year;
        //     return $userOrganization->role_id;
        // }
        //if the user is admin it will bypass the school year
        // else if ($userOrganization->role_id == 1){
        // session(['school_year' => $defaultSchoolYear->id]);
        session(['org_id' =>  $userOrganization->student_org_id]);
        session(['org_name' =>  $userOrganization->organization->name]);
        session(['role' =>  $userOrganization->role_id]);
        // session(['user_name' =>  $userOrganization->user_profile->first_name]);
        // session(['profile_picture' =>  $userOrganization->user_profile->image]);
        session(['user_school_year' =>  $userOrganization->school_year]);
        // session(['college_id' =>  $userOrganization->college_id]);
        // return $userOrganization->school_year;
        return $userOrganization->role_id;
        // }
        // else{
        //     return 'not_tagged_error';
        // }
        // }
        // //if the user is admin it will bypass if there is null organization default school year
        // else if ($userOrganization->role_id == 1){
        //     session(['school_year' =>  0]);
        //     session(['org_id' =>  $userOrganization->student_org_id]);
        //     session(['org_name' =>  $userOrganization->organization->name]);
        //     session(['role' =>  $userOrganization->role_id]);
        //     session(['user_name' =>  $userOrganization->user_profile->first_name]);
        //     // session(['college_id' =>  $userOrganization->college_id]);
        //     // return $userOrganization->school_year;
        //     return $userOrganization->role_id;
        // }
        // else{
        //     return 'not_tagged_errors';
        // }
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
        return redirect('/');
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

    public function changePassword(Request $request)
    {
        $user = User::find(Auth::id());
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'The provided password does not match our records.', 'status' => 0]);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
            'is_password_change' => 1
        ]);

        return response()->json(['message' => 'Change Password Success', 'status' => 1]);
        // return $user->password;
    }

    public function checkAuth()
    {
        if (Auth::id()) {
            if (Session::get('user_name')) {
                $role = Session::get('role');
                if ($role == 1) {
                    return redirect('/org_dashboard');
                } else if ($role == 2) {
                    return redirect('/student_dashboard');
                } else if ($role == 3) {
                    return redirect('/attendance_checker_dashboard');
                } else {
                    return redirect('/options');
                }
            }
        } else {
            return view('layouts.login');
        }
    }
    public function testroute()
    {
        $events = Event::get();

        // Compare user-inputted time with current time
        $currentTime = Carbon::now()->format('H:i');

        // foreach ($events as $event) {
        //     // return $event->event_id;
        //     if (Carbon::parse($event->end_session_scheduled_attendance)->format('H:i') == $currentTime) {
        //         $event_id = Event::find($event->event_id);
        //         $event_id->update([
        //             'attendance_status' => 2,
        //         ]);
        //     }
        // }
    }
}

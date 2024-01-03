<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserOrganization;
class UserOrgRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {

        // $userOrganizationCount = UserOrganization::where('student_id', Auth::id())->count();
        $userOrganizationRoleCount = UserOrganization::where([
            ['student_id',Auth::id()],
            ['role_id', $role]
        ])->count();

        if($userOrganizationRoleCount > 0){
            if (Auth::check()){
                return $next($request);
            }
        }
        else{
            return response()->json(["You don't have permission to access this page"]);
        }
        // else{
        //     $student_id = Auth::id();
        //     // $userOrganization = UserOrganization::where('student_id', $student_id)->get();
        //     // Fetch the user organizations for a specific student ID
        //     $userOrganizations = UserOrganization::where('student_id', $student_id)->first();
        //         // Loop through each user organization using foreach
        //         // foreach ($userOrganizations as $currentOrganization) {

        //         // }
        //         if (Auth::check() && $userOrganizations->role_id == $role){
        //             return $next($request);
        //         }
        //         //message to send to user when not enough permission
        //         else{
        //             return response()->json(["You don't have permission to access this page"]);
        //         }
        // }
        // return response()->json([$userOrganizationRoleCount]);
    }
}

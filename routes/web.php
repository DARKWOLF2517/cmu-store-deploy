<?php

use App\Http\Controllers\AccountabilitiesController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrgProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// PROFILE

Route::get('student_organization_profile', function () {
    return view('student_organization.student_organization_profile');
});
// general
    Route::get('/', function () {
        return view('layouts.login');
    });
    Route::post('/authenticate_user', [LoginController::class, 'authenticate'])->name('authentication');
    Route::get('/logout', [LoginController::class, 'logout']);


    Route::get('/login', function () {
        return view('layouts.login');
    })->name('login');
    Route::get('/events/show/{org_id}/{school_year?}',[EventController::class, 'getEvents'])->name('get-events');
    Route::get('/get_school_year_default/{org_id}',[EventController::class, 'getSchoolYearDefault']);
    Route::get('/events/attendance/{org_id}',[EventController::class, 'getEventsAttendance']);


    //get student org list
    Route::get('/usercards', function () {
        return view('layouts.organization_cards');
    });
    Route::get('/options', function () {
        $hideNav = true;
        return view('layouts.organization_cards',compact('hideNav'));
    })->name('login_options');
    Route::get('/GetOrgList/{userOrganization}', [LoginController::class, 'GetOrganizationList'])->name('get-user-organization');

    //get into organization that been choosen
    Route::get('/{org_id}/{role_id}/{organization_name}', [LoginController::class, 'LoginOrganization'])->name('login-organization');
    Route::get('/evaluation_result', function () {
        return view('student_organization.student_organization_evaluation_results');
        });
    #Announcement Page
    Route::get('student_organization_announcement', function () {
        return view('student_organization.student_organization_announcement');
    });

    //calendar events
    Route::get('/calendar/{org_id}',[EventController::class, 'getEventsForCalendar']);
    #ACCOUNTABILITIES ROUTE
    Route::get('/accountabilities/{org_id}',[AccountabilitiesController::class, 'getAccountabilities']);
    Route::get('/get_accountabilities/{org_id}', [AccountabilitiesController::class, 'getAccountabilitiesList']);


Route::middleware(['auth'])->group(function(){
#ORG ROUTE
    Route::middleware(['user-role:1'])->group(function(){
        #attendance
        Route::get('/attendance/show/{event_id}/{org_id}/{session}',[AttendanceController::class, 'showAttendanceList']);
        Route::get('/attendance/list/{organization_id}/{event_id}',[AttendanceController::class, 'AttendanceList']);
        Route::post('/attendance',[AttendanceController::class, 'store'])->name('add-attendance');
        Route::get('/attendance/count/{event_id}/{org_id}',[AttendanceController::class, 'AttendanceCount']);

        //check the repetition of the data using id number
        Route::get('/attendance_repetition/{result_id}/{session}/{event_id}',[AttendanceController::class, 'attendanceRepetition'])->name('repeat-attendance');

        //attendance record list
        Route::get('/attendance_record/{organization_id}',[AttendanceController::class, 'attendanceRecord']);

        //attendance status route
        Route::put('/attendance/{event_id}/{status}', [AttendanceController::class, 'update']);

        #USER ROUTE
        Route::get('getMemberRoute/{org_id}',[UserController::class, 'GetMemberList'])->name('member-list');

        //show students list  in the main form
        Route::get('/student_list/show/{org_id}',[UserController::class, 'showStudents']);
        Route::get('/student_list/edit/{student_id}',[UserController::class, 'showforEdit']);
        Route::put('/student_list/edit/commit/{student_id}',[UserController::class, 'UpdateData']);

        Route::post('/upload_students',[UserController::class, 'store']);
        #ORG DASHBOARD
            Route::get('/org_dashboard', function () {
                return view('student_organization.student_organization_dashboard');
            })->name('org_dashboard');



        // Route::get('student_organization_attendance_record/{event_id}', function () {
        //     return view('student_organization.student_organization_attendance_record');
        // });
        Route::get('student_organization_attendance_record/{event_id}',[AttendanceController::class, 'events']);

        Route::get('student_organization_attendance', function () {
            return view('student_organization.student_organization_attendance');
        });

        Route::get('student_organization_attendance_schedule', function () {
            return view('student_organization.student_organization_attendance_schedule');
        });

        Route::get('student_organization_attendance_records', function () {
            return view('student_organization.student_organization_attendance_records');
        });


        Route::get('student_organization_member_list', function () {
            return view('student_organization.student_organization_member_list');
        });

        Route::get('student_organization_students', function () {
            return view('student_organization.student_organization_students');
        });

        Route::get('student_organization_accountabilities_list', function () {
            return view('student_organization.student_organization_accountabilities_list');
        });

        Route::get('student_organization_accountabilities_records', function () {
            return view('student_organization.student_organization_accountabilities_records');
        });

        Route::get('student_organization_free_fines', function () {
            return view('student_organization.student_organization_free_fines');
        });


        Route::get('student_organization_set_accountabilities', function () {
            return view('student_organization.student_organization_set_accountabilities');
        });

        Route::get('student_organization_evaluation', function () {
            return view('student_organization.student_organization_evaluation');
        });

        Route::get('student_organization_events', function () {
            return view('student_organization.student_organization_events');
        });

            #QR SCANNER
            Route::get('student_qrscanner/{event_id}/{org_id}/{session}', [AttendanceController::class, 'showQR']);

            #EVALUATION ROUTES
            Route::get('/evaluation_form_summary/{event}', [EvaluationController::class, 'EvaluationFormSummary'])->name('EvaluationFormSummary');
            Route::get('/evaluation_form{event_id}', [EvaluationController::class, 'GetEvaluationResult'])->name('fetchEvaluation');
            Route::get('/evaluation_form_answer/{event_id}',[EvaluationController::class, 'EvaluationFormAnswer']);
            Route::get('/evaluation_form_total_response/{event_id}',[EvaluationController::class, 'EvaluationTotalResponse']);
            Route::get('/events/evaluation/{org_id}/{school_year?}',[EventController::class, 'getEvaluationList'])->name('get-evaluation');

            #EVENT ROUTES
            Route::get('/events', [EventController::class, 'showEvents'])->name('events');
            Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events-destroy');
            Route::post('/events', [EventController::class, 'store'])->name('event-store');
            Route::get('show_event_details/{event}', [EventController::class, 'showEventDetails'])->name('events-edit');
            Route::put('/events/{event}', [EventController::class, 'update'])->name('events-update');
            Route::get('/events_count/{org_id}',[EventController::class, 'getEventsCount']);
            Route::get('/user/count',[EventController::class, 'getMembersCount'])->name('get-user-count');
            Route::get('/get_school_year/{organization_id}',[EventController::class, 'getSchoolYear']);
            Route::get('/complete_events_count/{organization_id}',[EventController::class, 'getCompleteEventsCount']);



            #ACCOUNTABILITIES ROUTE
            Route::post('/set_accountabilities',[AccountabilitiesController::class, 'store']);
            Route::get('/fines_list/{org_id}',[AccountabilitiesController::class, 'AccountabilitiesListInAdmin']);
            Route::put('/update_event_attendance_status/{event_id}/{status}',[AccountabilitiesController::class, 'updateEventAttendanceStatus']);
            Route::post('/OtherAccountabilityPayment',[AccountabilitiesController::class, 'OtherAccountabilityPayment']);
            Route::post('/FinesAccountabilityPayment',[AccountabilitiesController::class, 'FinesAccountabilityPayment']);
            Route::post('/attendanceFill',[AccountabilitiesController::class, 'attendanceFill']);
            Route::delete('/delete_organization_accountability/{accountability_id}',[AccountabilitiesController::class, 'DeleteOrganizationAccountability']);
            Route::get('/paid_accountabilities/{org_id}',[AccountabilitiesController::class, 'PaidAccountabilities']);


            #ORG PROFILE ROUTE
            Route::post('/add_school_year',[OrgProfileController::class, 'addSchoolYear']);
            Route::get('/view_school_year/{org_id}',[OrgProfileController::class, 'viewSchoolYear']);
            Route::get('/edit_school_year/{id}',[OrgProfileController::class, 'fetchUpdateSchoolYear']);
            Route::put('/update_school_year/{id}',[OrgProfileController::class, 'updateSchoolYear']);
            Route::delete('/deleteSchoolYear/{id}',[OrgProfileController::class, 'DeleteSchoolYear']);
            Route::get('/view_officers/{org_id}',[OrgProfileController::class, 'viewOrgOfficer']);
            Route::get('/view_users_org/{org_id}',[OrgProfileController::class, 'viewUsersOrg']);
            Route::post('/add_org_officer',[OrgProfileController::class, 'addOrgOfficer']);
            Route::get('/edit_officer/{id}',[OrgProfileController::class, 'fetchUpdateOfficer']);
            Route::put('/update_officer/{id}',[OrgProfileController::class, 'updateOfficer']);
            Route::delete('/deleteOfficer/{id}',[OrgProfileController::class, 'DeleteOfficer']);
            Route::get('/view_roles',[OrgProfileController::class, 'viewRoles']);
            Route::post('/add_org_officer_role',[OrgProfileController::class, 'addOrgOfficerRole']);
            Route::get('/view_officer_role/{org_id}',[OrgProfileController::class, 'viewOfficerRole']);
            Route::put('/update_officer_role/{id}',[OrgProfileController::class, 'updateOfficerRole']);
            Route::delete('/delete_officer_role/{id}',[OrgProfileController::class, 'DeleteOfficerRole']);
            Route::get('/view_org_profile/{org_id}',[OrgProfileController::class, 'viewOrgProfile']);
            Route::get('/view_org_total_members/{org_id}',[OrgProfileController::class, 'viewOrgTotalMembers']);
            Route::put('/updateOrgProfileDetails/{id}',[OrgProfileController::class, 'updateOrgProfileDetails']);
    });
//STUDENT ROUTE
    Route::middleware(['user-role:2'])->group(function(){

        //test route

        Route::get('student_profile', function () {
            return view('student.student_profile');
        });

        Route::get('/student_dashboard', function () {
            return view('student.student_dashboard');
        });

        // Route::get('student_profile', function () {
        //     return view('student.student_profile');
        // });

        Route::get('student_accountabilities', function () {
            return view('student.student_accountabilities');
        });

        Route::get('student_announcement', function () {
            return view('student.student_announcement');
        });

        Route::get('/student_attendance', function () {
            return view('student.student_attendance');
        });

        //if user is done evaluating it will mark as done
        Route::get('/evaluation/user/status/{student_id}',[EvaluationController::class, 'isDoneEvaluation']);


        //get user organization
        //commented for testing purpose
        // Route::get('student_profile', function () {
        //     return view('student.student_profile');
        // });

        //get evaluation form title
        Route::get('/evaluation_form_title/{event_id}', [EvaluationController::class, 'EvaluationResultTitle']);

        //get students user profile
            Route::get('organization/{org_id}',[UserController::class, 'getUserOrganization']);
        //get user organization
            Route::get('profile/{student_id}',[UserController::class, 'getUserProfile']);
        //evaluation form
            Route::get('student_evaluation_list', function () {
                return view('student.student_evaluation_list');
            });
            Route::get('student_evaluationform', function () {
                return view('student.student_evaluation_form');
            });
            Route::post('/submit_evaluation',[EvaluationController::class, 'store']);
            Route::get('/evaluation_form/{event}', [EvaluationController::class, 'EvaluationForm'])->name('EvaluationForm');




    });
    Route::middleware(['user-role:3'])->group(function(){
        //Attendance Checker route
            Route::get('/attendance_checker_dashboard', function () {
                return view('attendance_checker.student_attendance_checker_dashboard');
            });

            Route::get('/attendance_checker_attendance_schedule', function () {
                return view('attendance_checker.student_attendance_schedule');
            });

            Route::get('/attendance_checker_attendance_records', function () {
                return view('attendance_checker.student_attendance_records');
            });


    });


});

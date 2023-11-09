<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
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
    return view('student.student_organization_profile');
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
    Route::get('/events/show/{org_id}',[EventController::class, 'getEvents'])->name('get-events');


    //get student org list
    Route::get('/usercards', function () {
        return view('layouts.organization_cards');
    });
    Route::get('login/options', function () {
        $hideNav = true;
        return view('layouts.organization_cards',compact('hideNav'));
    })->name('login_options');
    Route::get('login/GetOrgList/{userOrganization}', [LoginController::class, 'GetOrganizationList'])->name('get-user-organization');

    //get into organization that been choosen
    Route::get('login/{org_id}/{role_id}/{organization_name}', [LoginController::class, 'LoginOrganization'])->name('login-organization');

    Route::get('/evaluation_result', function () {
        return view('student_organization.student_organization_evaluation_results');
        });
    #Announcement Page
    Route::get('student_organization_announcement', function () {
        return view('student_organization.student_organization_announcement');
    });

    //calendar events
    Route::get('/events/calendar',[EventController::class, 'getEventsForCalendar'])->name('get-event-calendar');

    Route::middleware(['auth'])->group(function(){
    #ORG ROUTE
        Route::middleware(['user-role:1'])->group(function(){
            #attendance
            Route::get('/attendance/show/{event_id}/{org_id}',[AttendanceController::class, 'showAttendanceList']);
            //show attendance list  in the main form
            Route::get('/attendance/show/{org_id}',[AttendanceController::class, 'showAttendance']);
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

            Route::post('/upload_students',[UserController::class, 'store']);
            #ORG DASHBOARD
                Route::get('/login/org_dashboard', function () {
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

            Route::get('student_organization_fines', function () {
                return view('student_organization.student_organization_fines');
            });

            Route::get('student_organization_membership_fee', function () {
                return view('student_organization.student_organization_membership_fee');
            });

            //QR SCANNER
            Route::get('student_qrscanner/{event_id}/{org_id}/{session}', [AttendanceController::class, 'showQR']);

            #EVALUATION ROUTES
                Route::get('/evaluation_form_summary/{event}', [EvaluationController::class, 'EvaluationFormSummary'])->name('EvaluationFormSummary');
                Route::get('student_organization_evaluation', function () {
                    return view('student_organization.student_organization_evaluation');
                });
                Route::get('/evaluation_form{event_id}', [EvaluationController::class, 'GetEvaluationResult'])->name('fetchEvaluation');
                // Route::get('/evaluation_form_answer/{event_id}/{question_id}/{option}',[EvaluationController::class, 'EvaluationFormAnswer']);
                Route::get('/evaluation_form_answer/{event_id}',[EvaluationController::class, 'EvaluationFormAnswer']);
                //get event total response
                Route::get('/evaluation_form_total_response/{event_id}',[EvaluationController::class, 'EvaluationTotalResponse']);
                Route::get('/evaluation_list/{org_id}',[EvaluationController::class, 'EvaluationList']);
                //get evaluation form title
                Route::get('/evaluation_form_title/{event_id}', [EvaluationController::class, 'EvaluationResultTitle']);

                #EVENT ROUTES
                Route::get('student_organization_events', function () {
                    return view('student_organization.student_organization_events');
                });


                Route::get('/events', [EventController::class, 'showEvents'])->name('events');
                Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events-destroy');
                Route::post('/events', [EventController::class, 'store'])->name('event-store');
                Route::get('edit/events/{event}', [EventController::class, 'edit'])->name('events-edit');
                Route::put('/events/{event}', [EventController::class, 'update'])->name('events-update');


                Route::get('/events/count',[EventController::class, 'getEventsCount'])->name('get-events-count');
                Route::get('/user/count',[EventController::class, 'getMembersCount'])->name('get-user-count');
        });
    //STUDENT ROUTE
        Route::middleware(['user-role:2'])->group(function(){
            Route::get('/login/student_dashboard', function () {
                return view('student.student_dashboard');
            });

            Route::get('student_profile', function () {
                return view('student.student_profile');
            });

            Route::get('student_accountabilities', function () {
                return view('student.student_accountabilities');
            });

            Route::get('student_announcement', function () {
                return view('student.student_announcement');
            });

            Route::get('student_attendance', function () {
                return view('student.student_attendance');
            });

            Route::get('student_profile', function () {
                return view('student.student_profile');
            });

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
    });

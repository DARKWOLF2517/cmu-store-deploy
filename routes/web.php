<?php

use App\Http\Controllers\AccountabilitiesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OrgProfileController;
use App\Http\Controllers\UserController;
use App\Mail\WelcomeEmail;
use App\Models\Accountability;
use App\Models\Announcement;
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


// general
Route::get('/', [LoginController::class, 'checkAuth']);
Route::post('/authenticate_user', [LoginController::class, 'authenticate'])->name('authentication');
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/login', [LoginController::class, 'checkAuth'])->name('login'); //important

Route::get('/testroute', [LoginController::class, 'testroute']); //important

//can access to all roles
Route::middleware(['auth'])->group(function () {
    Route::get('qrscan', function () {
        return view('attendance_checker.qrscanner');
    });

    #MAIL ROUTES
    Route::post('/send_mail', [MailController::class,  'AttendanceCheck']);
    Route::get('/get_evaluation_feedback/{evaluation_id}/{event_id}', [EvaluationController::class, 'getEvaluationFeedback']);
    Route::get('/events/show/{org_id?}/{school_year?}', [EventController::class, 'getEvents'])->name('get-events');
    Route::get('/get_school_year_default/{org_id}', [EventController::class, 'getSchoolYearDefault']);
    Route::get('/events/attendance/{org_id}/{school_year}', [EventController::class, 'getEventsAttendance']);
    Route::get('/get_school_year', [EventController::class, 'getSchoolYear']);
    #ATTENDANCE
    Route::get('/attendance/count/{event_id}/{org_id}', [AttendanceController::class, 'AttendanceCount']);
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('add-attendance');
    Route::get('/attendance_record/{organization_id}/{school_year}', [AttendanceController::class, 'attendanceRecord']);
    Route::get('/attendance/list/{organization_id}/{event_id}', [AttendanceController::class, 'AttendanceList']);
    Route::get('student_organization_attendance_record/{event_id}', [AttendanceController::class, 'events']);
    Route::post('/upload_event_attendance_checker/{event_id}', [AttendanceController::class, 'uploadEventAttendanceChecker']);
    Route::get('check_attendance_status/{event_id}', [AttendanceController::class, 'checkAttendanceStatus']);
    // Route::get('attendance_checker_count/{event_id}', [AttendanceController::class, 'attendanceCheckerCount']);
    #DASHBOARD
    Route::get('/view_org_total_members/{org_id}/{school_year}', [OrgProfileController::class, 'viewOrgTotalMembers']);
    Route::get('/events_count/{org_id}/{school_year}', [EventController::class, 'getEventsCount']);
    Route::get('/total_paid_accountabilities/{organization_id}/{school_year}', [EventController::class, 'getCompleteEventsCount']);
    //ANNOUNCEMENT
    Route::get('/get_announcement/{org_id}/{school_year}', [AnnouncementController::class, 'getAnnouncement']);
    Route::post('/addAnnouncement/{org_id}/{school_year}', [AnnouncementController::class, 'addAnnouncement']);
    Route::get('/fetchEditAnnouncement/{id}', [AnnouncementController::class, 'fetchEditAnnouncement']);
    Route::put('/updateAnnouncement/{id}', [AnnouncementController::class, 'updateAnnouncement']);
    Route::delete('/delete_announcement/{id}', [AnnouncementController::class, 'deleteAnnouncement']);
    Route::get('/get_student_opened_announcement/{school_year}', [AnnouncementController::class, 'getStudentOpenedAnnouncement']);
    Route::post('/addStudentOpenedAnnouncement/{announcement_id}/{school_year}', [AnnouncementController::class, 'addStudentOpenedAnnouncement']);
    //EVALUATION FORM
    Route::post('/submit_evaluation/{user_id}/{event_id}', [EvaluationController::class, 'store']);
    Route::get('/event_evaluation_form/{event_id}/{org_id}', [EvaluationController::class, 'getEventEvaluationForm']);

    //USER
    Route::get('/student_list/show_name/{student_id}', [UserController::class, 'showforEdit']);
    Route::get('student_organization_profile', function () {
        return view('student_organization.student_organization_profile');
    });
    Route::get('/view_college', [UserController::class, 'viewCollege']);

    //get student org list
    Route::get('/usercards', function () {
        return view('layouts.organization_cards');
    });
    Route::get('/options', function () {
        $hideNav = true;
        return view('layouts.organization_cards', compact('hideNav'));
    })->name('login_options');
    Route::get('/GetOrgList/{userOrganization}', [LoginController::class, 'GetOrganizationList'])->name('get-user-organization');

    //get into organization that been choosen in profile
    Route::get('/profile_clicked/{id}', [LoginController::class, 'LoginOrganization'])->name('login-organization');
    Route::get('/evaluation_result', function () {
        return view('student_organization.student_organization_evaluation_results');
    });
    #Announcement Page
    Route::get('student_organization_announcement', function () {
        return view('student_organization.student_organization_announcement');
    });

    //calendar events
    Route::get('/calendar/{org_id}/{school_year}', [EventController::class, 'getEventsForCalendar']);
    #ACCOUNTABILITIES ROUTE
    Route::get('/accountabilities_students/{org_id}/{school_year}', [AccountabilitiesController::class, 'getAccountabilities']);
    Route::get('/get_accountabilities/{org_id}/{school_year}', [AccountabilitiesController::class, 'getAccountabilitiesList']);
    Route::get('/get_user_orgs/{school_year}', [AccountabilitiesController::class, 'getUserOrgs']);
    Route::get('/get_student_payment_history/{user_id}/{org_id}', [AccountabilitiesController::class, 'getStudentPaymentHistory']);

    #attendance route
    Route::get('student_qrscanner/{event_id}/{org_id}/{session}', [AttendanceController::class, 'showQR']);
    Route::get('/attendance/show/{event_id}/{org_id}/{session}', [AttendanceController::class, 'showAttendanceList']);
    Route::get('back_to_schedule', [AttendanceController::class, 'back']);

    #Change password Page
    Route::get('change_password', function () {
        return view('layouts.set_new_password');
    });
    Route::post('/change_password_data', [LoginController::class, 'changePassword']);

    #ORG ROUTE
    Route::middleware(['user-role:1'])->group(function () {
        #ORG DASHBOARD
        Route::get('/org_dashboard', function () {
            return view('student_organization.student_organization_dashboard');
        })->name('org_dashboard');

        // Route::get('student_organization_attendance_record/{event_id}', function () {
        //     return view('student_organization.student_organization_attendance_record');
        // });
        Route::get('student_organization_activity_logs', function () {
            return view('student_organization.activity_logs');
        });

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
        Route::get('student_organization_accountability_report', function () {
            return view('student_organization.student_organization_accountability_report');
        });

        Route::get('student_organization_evaluation', function () {
            return view('student_organization.student_organization_evaluation');
        });

        Route::get('student_organization_evaluation_results_table', function () {
            return view('student_organization.student_organization_evaluation_result_table');
        });

        Route::get('student_organization_evaluation_forms', function () {
            return view('student_organization.student_organization_evaluation_forms');
        });


        Route::get('student_organization_events', function () {
            return view('student_organization.student_organization_events');
        });

        #FUNCTIONS WITH DATA ROUTES
        #USER ROUTE
        Route::get('getMemberRoute/{org_id}', [UserController::class, 'GetMemberList'])->name('member-list');
        Route::get('/student_list/show/{org_id}/{school_year}', [UserController::class, 'showStudents']);
        Route::put('/student_list/edit/commit/{student_id}', [UserController::class, 'UpdateData']);
        Route::post('/upload_students/{school_year}/{year_level}/{college_id}', [UserController::class, 'store']);
        Route::post('/upload_single_student/{school_year}', [UserController::class, 'addSingleStudent']);
        Route::put('/update_single_student', [UserController::class, 'updateSingleStudent']);
        Route::delete('/delete_single_student/{id}', [UserController::class, 'deleteSingleStudent']);
        Route::get('/get_organization_college/{org_id}', [UserController::class, 'viewOrgCollege']);

        #ATTENDANCE ROUTES

        Route::get('/attendance_repetition/{result_id}/{session}/{event_id}', [AttendanceController::class, 'attendanceRepetition'])->name('repeat-attendance');
        Route::put('/attendance/{event_id}/{status}', [AttendanceController::class, 'update']);
        Route::delete('/delete_attendance/{id}/{session}', [AttendanceController::class, 'deleteAttendance']);

        #EVALUATION ROUTES
        Route::get('/evaluation_form_summary/{event_id}/{evaluation_id}', [EvaluationController::class, 'EvaluationFormSummary'])->name('EvaluationFormSummary');
        Route::get('/evaluation_form{event_id}', [EvaluationController::class, 'GetEvaluationResult'])->name('fetchEvaluation');
        Route::get('/evaluation_form_answer/{event_id}', [EvaluationController::class, 'EvaluationFormAnswer']);
        Route::get('/evaluation_form_total_response/{event_id}', [EvaluationController::class, 'EvaluationTotalResponse']);
        Route::get('/events/evaluation/{org_id}/{school_year?}', [EventController::class, 'getEvaluationList'])->name('get-evaluation');
        //new evaluation//
        Route::get('/evaluation_answer/{evaluation_id}', [EvaluationController::class, 'EvaluationAnswer']);
        Route::post('/upload_evaluation_form', [EvaluationController::class, 'uploadEvaluationForm']);
        Route::get('/getEvaluationForm/{org_id}/{school_year}', [EvaluationController::class, 'getEvaluationForm']);
        Route::delete('/delete_evaluation_form/{evaluation_form_id}', [EvaluationController::class, 'deleteEvaluationForm']);

        Route::get('/get_events/{event_id}', [EvaluationController::class, 'getEvents']);
        Route::get('/fetchEvaluationFormUpdate/{evaluation_id}', [EvaluationController::class, 'getEvaluationFormUpdate']);
        Route::put('/updateEvaluationForm', [EvaluationController::class, 'updateEvaluationForm']);
        Route::get('/getTotalResponse/{event_id}', [EvaluationController::class, 'getTotalResponse']);

        #EVENT ROUTES
        Route::get('/events', [EventController::class, 'showEvents'])->name('events');
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events-destroy');
        Route::post('/events', [EventController::class, 'store'])->name('event-store');
        Route::get('show_event_details/{event}', [EventController::class, 'showEventDetails'])->name('events-edit');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('events-update');
        Route::get('/user/count', [EventController::class, 'getMembersCount'])->name('get-user-count');
        Route::post('/submitYearLevelExempted/{org_id}/{school_year}/{event_id}', [EventController::class, 'submitYearLevelExempted']);
        Route::get('/get_year_level/{organization_id}', [EventController::class, 'getYearLevel']);
        Route::get('/yearLevel/exempted/{org_id}/{id}', [EventController::class, 'getExempted']);
        Route::put('/update_event_status/{id}/{status}', [EventController::class, 'updateEventStatus']);
        Route::post('/submitCancelAttendanceEvent/{event_id}/{school_year}/{org_id}', [EventController::class, 'submitCancelAttendanceEvent']);
        Route::get('/show_cancelled_attendance/{event_id}', [EventController::class, 'showCancelledAttendance']);

        #ACCOUNTABILITIES ROUTES
        Route::post('/set_accountabilities', [AccountabilitiesController::class, 'store']);
        Route::get('/fees_list/{org_id}/{school_year}', [AccountabilitiesController::class, 'AccountabilitiesListInAdmin']);
        Route::put('/update_event_attendance_status/{event_id}/{status}', [AccountabilitiesController::class, 'updateEventAttendanceStatus']);
        Route::post('/OtherAccountabilityPayment', [AccountabilitiesController::class, 'OtherAccountabilityPayment']);
        Route::post('/FinesAccountabilityPayment/{school_year}/{amount}/{accountability_type}', [AccountabilitiesController::class, 'FinesAccountabilityPayment']);
        Route::post('/attendanceFill', [AccountabilitiesController::class, 'attendanceFill']);
        Route::delete('/delete_organization_accountability/{accountability_id}/{org_id}', [AccountabilitiesController::class, 'DeleteOrganizationAccountability']);
        Route::get('/paid_accountabilities/{org_id}/{school_year}', [AccountabilitiesController::class, 'PaidAccountabilities']);
        Route::get('/accountabilities_fetch_update/{id}', [AccountabilitiesController::class, 'accountabilitiesFetchUpdate']);
        Route::put('/update_accountabilities/{id}/{old_name}/{org_id}', [AccountabilitiesController::class, 'updateAccountabilities']);
        Route::get('/get_org_accountability/{org_id}/{school_year}', [AccountabilitiesController::class, 'getOrgAccountability']);
        Route::get('/get_student_payments/{student_id}', [AccountabilitiesController::class, 'getStudentPayments']);
        Route::delete('/delete_paid_accountabilities/{accountability_id}', [AccountabilitiesController::class, 'deletePaidAccountabilities']);
        Route::get('/get_accountability_amount/{accountability_type}/{school_year}', [AccountabilitiesController::class, 'getAccountabilityType']);

        #ORG PROFILE ROUTES
        Route::get('/view_school_year', [OrgProfileController::class, 'viewSchoolYear']);
        Route::get('/view_officers/{org_id}/{school_year}', [OrgProfileController::class, 'viewOrgOfficer']);
        Route::get('/view_users_org/{org_id}', [OrgProfileController::class, 'viewUsersOrg']);
        Route::post('/add_org_officer', [OrgProfileController::class, 'addOrgOfficer']);
        Route::get('/edit_officer/{id}', [OrgProfileController::class, 'fetchUpdateOfficer']);
        Route::put('/update_officer/{id}', [OrgProfileController::class, 'updateOfficer']);
        Route::delete('/deleteOfficer/{id}', [OrgProfileController::class, 'DeleteOfficer']);
        Route::get('/view_roles', [OrgProfileController::class, 'viewRoles']);
        Route::post('/add_org_officer_role', [OrgProfileController::class, 'addOrgOfficerRole']);
        Route::get('/view_officer_role/{org_id}/{school_year}', [OrgProfileController::class, 'viewOfficerRole']);
        Route::put('/update_officer_role/{id}', [OrgProfileController::class, 'updateOfficerRole']);
        Route::delete('/delete_officer_role/{id}', [OrgProfileController::class, 'DeleteOfficerRole']);
        Route::get('/view_org_profile/{org_id}', [OrgProfileController::class, 'viewOrgProfile']);

        Route::post('/updateOrgProfileDetails/{id}', [OrgProfileController::class, 'updateOrgProfileDetails']);
        Route::post('/updateOrgProfileImage/{id}', [OrgProfileController::class, 'updateOrgProfileImage']);
        Route::get('/fetch_name_officer_input/{id}/{org_id}', [OrgProfileController::class, 'fetchNameOfficerInput']);
        Route::get('/view_year_level/{org_id}', [OrgProfileController::class, 'fetchYearLevel']);
        Route::post('/add_year_level', [OrgProfileController::class, 'addYearLevel']);
        Route::delete('/delete_year_level/{id}', [OrgProfileController::class, 'DeleteYearLevel']);
        Route::get('/year_level_fetch_update/{id}', [OrgProfileController::class, 'yearLevelFetchUpdate']);
        Route::put('/update_year_level/{id}', [OrgProfileController::class, 'updateYearLevel']);
        Route::get('/org_officer_count/{org_id}/{school_year}', [OrgProfileController::class, 'orgOfficerCount']);

        #FREE FINES ROUTES
        Route::get('/get_free_fines_students/{org_id}/{school_year}', [AccountabilitiesController::class, 'viewFreeFinesStudents']);
        Route::post('/add_free_fines_students', [AccountabilitiesController::class, 'addFreeFinesStudents']);
        Route::get('/get_student_name/{student_id}', [AccountabilitiesController::class, 'getStudentName']);
        Route::delete('/delete_student_free_fines/{student_id}', [AccountabilitiesController::class, 'deleteStudentFreeFines']);
        Route::get('/fetch_update_student_data/{student_id}', [AccountabilitiesController::class, 'fetchUpdateStudentData']);
        Route::put('/update_student_data/{student_id}/{reason}', [AccountabilitiesController::class, 'updateStudentData']);

        #ACCOUNTABILITY REPORT
        Route::get('/fetch_accountabilities/{org_id}', [AccountabilitiesController::class, 'fetchAccountabilities']);
    });
    //STUDENT ROUTE
    Route::middleware(['user-role:2'])->group(function () {
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
        Route::get('/evaluation/user/status/{student_id}', [EvaluationController::class, 'isDoneEvaluation']);


        //get user organization
        //commented for testing purpose
        // Route::get('student_profile', function () {
        //     return view('student.student_profile');
        // });

        //get evaluation form title
        Route::get('/evaluation_form_title/{event_id}', [EvaluationController::class, 'EvaluationResultTitle']);

        //STUDENT PROFILE
        Route::get('organization/{org_id}', [UserController::class, 'getUserOrganization']);
        Route::post('uploadProfilePictureForStudent/{user_id}', [UserController::class, 'uploadProfilePictureForStudent']);
        Route::put('updateEmail/{email}', [UserController::class, 'updateEmail']);
        //get user organization

        Route::get('profile/{student_id}', [UserController::class, 'getUserProfile']);
        //EVALUATION FORM
        Route::get('student_evaluation_list', function () {
            return view('student.student_evaluation_list');
        });
        Route::get('student_evaluationform', function () {
            return view('student.student_evaluation_form');
        });

        Route::get('/evaluation_form/{event}', [EvaluationController::class, 'EvaluationForm'])->name('EvaluationForm');
        Route::get('/get_evaluation_question/{evaluation_form_id}', [EvaluationController::class, 'getEvaluationQuestion']);
        Route::get('/evaluation_form_summary/{event}/{evaluation_form}', [EvaluationController::class, 'EvaluationFormResult']);
        Route::get('/evaluation_form_result_student/{evaluation_form_id}/{event_id}', [EvaluationController::class, 'getEvaluationFormResultStudent']);
        Route::get('/get_choice_name/{evaluation_form_id}/{event_id}', [EvaluationController::class, 'getChoiceName']);

        //ANNOUNCEMENT ROUTE
        Route::get('/get_student_annoucement/{school_year}', [AnnouncementController::class, 'getStudentAnnouncement']);

        //DASHBOARD ROUTE
        Route::get('/events_student_dashboard/{school_year}', [EventController::class, 'eventStudentDashboard']);
        Route::get('/calendar_student_dashboard/{school_year}', [EventController::class, 'calendarStudentDashboard']);

        //ACCOUNTABILITIES ROUTE
        Route::get('/get_free_fines_student/{user_id}/{org_id}/{school_year}', [AccountabilitiesController::class, 'getFreeFinesStudent']);
        Route::get('/get_session_exempted_attendance/{org_id}/{school_year}', [AccountabilitiesController::class, 'getSessionExemptedAttendance']);
    });
    Route::middleware(['user-role:3'])->group(function () {
        //Attendance Checker route
        Route::get('/attendance_checker_dashboard', function () {
            return view('attendance_checker.student_attendance_checker_dashboard');
        });

        Route::get('/attendance_checker_attendance_schedule', function () {
            return view('attendance_checker.student_attendance_schedule');
        });



        Route::get('/attendance_checker_attendance_records_list', function () {
            return view('attendance_checker.student_attendance');
        });

        Route::get('/attendance_checker_attendance_records', function () {
            return view('attendance_checker.student_attendance_records');
        });
    });

    //OSA ROUTE
    Route::middleware(['user-role:4'])->group(function () {

        Route::get('OSA', function () {
            return view('layouts.osa');
        });
        Route::post('/add_school_year', [AdminController::class, 'addSchoolYear']);
        Route::get('/edit_school_year/{id}', [AdminController::class, 'fetchUpdateSchoolYear']);
        Route::put('/update_school_year/{id}', [AdminController::class, 'updateSchoolYear']);
        Route::delete('/deleteSchoolYear/{id}', [AdminController::class, 'DeleteSchoolYear']);
        Route::post('/add_college', [AdminController::class, 'addCollege']);
        Route::get('/edit_college/{id}', [AdminController::class, 'fetchCollegeEdit']);
        Route::put('/update_college/{id}', [AdminController::class, 'updateCollege']);
        Route::delete('/delete_college/{id}', [AdminController::class, 'deleteCollege']);
        Route::get('/get_organization', [AdminController::class, 'getOrganization']);
        Route::post('/add_organization', [AdminController::class, 'addOrganization']);
        Route::get('/edit_organization/{id}', [AdminController::class, 'editOrganization']);
        Route::put('/update_organization/{id}', [AdminController::class, 'updateOrganization']);
        Route::delete('/delete_organization/{id}', [AdminController::class, 'deleteOrganization']);
        Route::get('/get_organization_admins', [AdminController::class, 'getOrganizationAdmins']);
        Route::post('/add_organization_admin', [AdminController::class, 'addOrganizationAdmin']);
        Route::get('/edit_organization_admin/{id}', [AdminController::class, 'editOrganizationAdmin']);
        Route::put('/update_organization_admin/{id}', [AdminController::class, 'updateOrganizationAdmin']);
        Route::delete('/delete_organization_admin/{id}/{student_id}', [AdminController::class, 'deleteOrganizationAdmin']);
    });
});

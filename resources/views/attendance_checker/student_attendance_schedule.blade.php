
@extends('layouts.attedance_checker_navigation_bar')
<link href="/custom_css/SOAttendance.css" rel="stylesheet">
@section('main-content')
<div class="content">
    <div class="container">
        <div class="container breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/login/org_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Organization</li>
                <li class="breadcrumb-item active" aria-current="page">Attendance</li>
                <li class="breadcrumb-item active" aria-current="page">Schedule</li>
                </ol>
            </nav>
        </div>


            <h3 class="mt-2">
                <i class="fas fa-list"></i> Scheduled Attendance
            </h3>

                <div class="row">
                <div class="col-lg-6 mb-2">
                    <div class="container" id="ScheduledEventContainer">
                        <event-attendance-list
                        org_id="{{Session::get('org_id')}}">
                        </event-attendance-list>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div id="calendar">
                        <dashboard-calendar>
                        </dashboard-calendar>
                    </div>
                </div>
        </div>
    </div>
    </div>
    </div>




@endsection

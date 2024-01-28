@extends('layouts.main_layout')
@section('custom-style')
<link href="/custom_css/SOAttendance.css" rel="stylesheet">
<title> Schedule @yield('title')</title>
@endsection

@section('main-content')

        <div class="col-md breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/org_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Attendance Checker</li>
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
                    <div id="ScheduledEventContainer">
                        <event-attendance-list
                        :org_id="{{Session::get('org_id')}}"
                        :school_year_session="{{Session::get('school_year')}}"
                        >
                        </event-attendance-list>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div id="calendar">
                        <dashboard-calendar
                            :org_id = {{Session::get('org_id')}}
                            :school_year_session = {{Session::get('school_year')}}
                        >
                        </dashboard-calendar>
                    </div>
                </div>
        </div>



@endsection

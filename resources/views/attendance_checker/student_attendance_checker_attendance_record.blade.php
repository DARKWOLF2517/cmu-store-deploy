
@extends('layouts.attedance_checker_navigation_bar')
@section('custom-style')
<link href="/custom_css/SOAttendance.css" rel="stylesheet">
@endsection

@section('main-content')

            <div class="col breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/org_dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item">Attendance Checker</li>
                    <li class="breadcrumb-item"><a href="/student_organization_attendance">Attendance</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Attendance Record</li>
                    </ol>
                </nav>
            </div>

                    <show-student-attendance
                        :event_id = {{$event_id}}
                        :organization_id = {{Session::get('org_id')}}
                    >

                    </show-student-attendance>



@endsection

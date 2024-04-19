@extends('layouts.main_layout')

@section('custom-title')
    <title> Attendance record</title>
@endsection

@section('custom-style')
    <link href="{{ asset('/custom_css/SOAttendance.css') }}" rel="stylesheet">
@endsection

@section('main-content')
    <div class="col breadcrumbs">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/org_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Organization</li>
                <li class="breadcrumb-item"><a href="/student_organization_attendance">Attendance</a></li>
                <li class="breadcrumb-item active" aria-current="page">Attendance Record</li>
            </ol>
        </nav>
    </div>

    <show-student-attendance :event_id={{ $event_id }} :school_year_session={{ $school_year }}
        :organization_id={{ Session::get('org_id') }} :user_school_year={{ Session::get('user_school_year') }}>

    </show-student-attendance>
@endsection

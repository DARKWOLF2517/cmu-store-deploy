@extends('layouts.main_layout')
<link href="/custom_css/SOAttendance.css" rel="stylesheet">
<title>Student Organization Attendance @yield('title')</title>
@section('main-content')
    <attendance-record
    :organization_id = {{Session::get('org_id')}}
    :school_year_session = {{Session::get('school_year')}}
    >
    </attendance-record>
@endsection

@extends('layouts.main_layout')
<title>Attendance @yield('title')</title>
@section('custom-script')
<link href="/custom_css/SOAttendance.css" rel="stylesheet">
@endsection
@section('main-content')
    <attendance-record
    :organization_id = {{Session::get('org_id')}}
    :school_year_session = {{Session::get('school_year')}}
    >
    </attendance-record>
@endsection



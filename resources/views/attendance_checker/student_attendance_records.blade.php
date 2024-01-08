
@extends('layouts.attedance_checker_navigation_bar')
<link href="/custom_css/SOAttendance.css" rel="stylesheet">

@section('main-content')
    <attendance-record
    :organization_id = {{Session::get('org_id')}}
    :school_year_session = {{Session::get('school_year')}}
    >
    </attendance-record>
@endsection



@extends('layouts.main_layout')

@section('custom-title')
  <title> Attendance</title>
@endsection

@section('custom-style')
<link href="{{ asset('/custom_css/SOAttendance.css') }}" rel="stylesheet">
@endsection

@section('main-content')
    <attendance-record
    :organization_id = {{Session::get('org_id')}}
    :school_year_session = {{Session::get('school_year')}}
    >
    </attendance-record>
@endsection

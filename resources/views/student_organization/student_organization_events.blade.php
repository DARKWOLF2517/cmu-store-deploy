
@extends('layouts.student_organization_navigation_bar')
{{-- @section('custom-style')
  <link href="/custom_css/SOEvents.css" rel="stylesheet">
@endsection --}}
<title>Student Organization Events @yield('title')</title>
<link href="/custom_css/SOEvents.css" rel="stylesheet">
@section('main-content')


        <event-card
        :organization_id = {{Session::get('org_id')}}
        :school_year_session = {{Session::get('school_year')}}
        >
        </event-card>

@endsection

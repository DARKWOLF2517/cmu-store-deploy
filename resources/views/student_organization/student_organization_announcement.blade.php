@extends('layouts.main_layout')
{{-- @section('custom-style')
  <link href="/custom_css/SOEvents.css" rel="stylesheet">
@endsection --}}
<link href="/custom_css/announcement.css" rel="stylesheet">
<title>Student Organization Announcements @yield('title')</title>
@section('main-content')

        <announcement-card
        organization_id = {{Session::get('org_id')}}>
        </announcement-card>
        {{-- <event-card
        organization_id = {{Session::get('org_id')}}>
        </event-card> --}}

@endsection

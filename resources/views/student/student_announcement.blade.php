@extends('layouts.student_navigation_bar')

<link href="/custom_css/studentAnnouncement.css" rel="stylesheet">
<title>Student Announcement @yield('title')</title>
@section('main-content')

        <student-announcement-card
        organization_id = {{Session::get('org_id')}}>
        </student-announcement-card>
        {{-- <event-card
        organization_id = {{Session::get('org_id')}}>
        </event-card> --}}

@endsection



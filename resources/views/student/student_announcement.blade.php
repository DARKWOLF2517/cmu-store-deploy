@extends('layouts.student_navigation_bar')
@section('main-content')
<link href="/custom_css/studentAnnouncement.css" rel="stylesheet">
@section('main-content')

        <student-announcement-card
        organization_id = {{Session::get('org_id')}}>
        </student-announcement-card>
        {{-- <event-card
        organization_id = {{Session::get('org_id')}}>
        </event-card> --}}

@endsection



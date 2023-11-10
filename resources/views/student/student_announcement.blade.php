@extends('layouts.student_navigation_bar')
@section('main-content')
<link href="/custom_css/studentAnnouncement.css" rel="stylesheet">
@section('main-content')

<div class="content">
    <div class="container">
        <student-announcement-card
        organization_id = {{Session::get('org_id')}}>
        </student-announcement-card>
        {{-- <event-card
        organization_id = {{Session::get('org_id')}}>
        </event-card> --}}
    </div>
</div>

@endsection



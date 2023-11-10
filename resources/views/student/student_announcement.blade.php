@extends('layouts.student_navigation_bar')
@section('main-content')
<link href="/custom_css/studentAnnouncement.css" rel="stylesheet">
@section('main-content')

<div class="content">
    <div class="container">
        <announcement-card
        organization_id = {{Session::get('org_id')}}>
        </announcement-card>
        {{-- <event-card
        organization_id = {{Session::get('org_id')}}>
        </event-card> --}}
    </div>
</div>

@endsection



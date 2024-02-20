@extends('layouts.main_layout')

<link href="/custom_css/studentAnnouncement.css" rel="stylesheet">
@section('custom-title')
  <title> Announcements</title>
@endsection
@section('main-content')

        <student-announcement-card
        organization_id = {{Session::get('org_id')}}>
        </student-announcement-card>
        {{-- <event-card
        organization_id = {{Session::get('org_id')}}>
        </event-card> --}}

@endsection



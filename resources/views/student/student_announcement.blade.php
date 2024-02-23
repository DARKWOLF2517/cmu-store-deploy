@extends('layouts.main_layout')

@section('custom-title')
  <title> Announcements</title>
@endsection
@section('custom-style')
<link href="{{ asset('/custom_css/studentAnnouncement.css') }}" rel="stylesheet">
@endsection
@section('main-content')

        <student-announcement-card
        organization_id = {{Session::get('org_id')}}>
        </student-announcement-card>
        {{-- <event-card
        organization_id = {{Session::get('org_id')}}>
        </event-card> --}}

@endsection



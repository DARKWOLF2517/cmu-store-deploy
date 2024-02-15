@extends('layouts.main_layout')
@section('custom-style')
  <link href="/custom_css/announcement.css" rel="stylesheet">
@endsection
@section('custom-title')
  <title> Student Organization Announcements</title>
@endsection

@section('main-content')

        <announcement-card
          :org_id = {{Session::get('org_id')}}
          :school_year_session = {{Session::get('school_year')}}
        >
        </announcement-card>
@endsection

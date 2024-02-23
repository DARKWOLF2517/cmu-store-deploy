@extends('layouts.main_layout')
@section('custom-title')
  <title> Announcements</title>
@endsection

@section('custom-style')
  <link href="{{ asset('/custom_css/announcement.css') }}" rel="stylesheet">
@endsection


@section('main-content')

        <announcement-card
          :org_id = {{Session::get('org_id')}}
          :school_year_session = {{Session::get('school_year')}}
        >
        </announcement-card>
@endsection

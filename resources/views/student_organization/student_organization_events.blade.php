@extends('layouts.main_layout')

@section('custom-title')
  <title> Events</title>
@endsection
@section('custom-style')
<link href="{{ asset('/custom_css/SOEvents.css') }}" rel="stylesheet">
@endsection
@section('main-content')


        <event-card
        :organization_id = {{Session::get('org_id')}}
        :school_year_session = {{Session::get('school_year')}}
        >
        </event-card>

@endsection

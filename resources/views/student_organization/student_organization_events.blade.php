
@extends('layouts.student_organization_navigation_bar')
{{-- @section('custom-style')
  <link href="/custom_css/SOEvents.css" rel="stylesheet">
@endsection --}}
<link href="/custom_css/SOEvents.css" rel="stylesheet">
@section('main-content')

<div class="content">
    <div class="container">

        <event-card
        organization_id = {{Session::get('org_id')}}
        :school_year_session = {{Session::get('school_year')}}
        >
        </event-card>
    </div>
</div>

@endsection

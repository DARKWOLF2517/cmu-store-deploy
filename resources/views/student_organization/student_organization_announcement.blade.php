
@extends('layouts.student_organization_navigation_bar')
{{-- @section('custom-style')
  <link href="/custom_css/SOEvents.css" rel="stylesheet">
@endsection --}}
<link href="/custom_css/announcement.css" rel="stylesheet">
@section('main-content')

<div class="page-content-wapper">
    <div class="content">
        <div class="page-container">

        <announcement-card
        organization_id = {{Session::get('org_id')}}>
        </announcement-card>
        {{-- <event-card
        organization_id = {{Session::get('org_id')}}>
        </event-card> --}}
    </div>
</div>
</div>
@endsection

@extends('layouts.main_layout')
@section('custom-title')
    <title> Student Dashboard</title>
@endsection
@section('custom-style')
    <link href="/custom_css/SODashboard.css" rel="stylesheet">
@endsection
@section('main-content')
    <div class="row">
        <div class="col mt-2">
            <div class="welcome-card-student" >
                <div class="welcome-text">
                    <p>Welcome, {{ Session::get('user_name') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col mt-2">
        <div class="row">
            <div class="col-lg-4 col-md-12 mb-2">
                <div class="timeline-schedule">
                    <div class="timeline-header">
                        <i class="bi bi-list"></i> Event Timeline
                    </div>
                    <event-dashboard :organization_id={{ Session::get('org_id') }}
                        :school_year_session={{ Session::get('school_year') }}>

                    </event-dashboard>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 mb-3">
                <div class="announcement" >
                    <div class="announcement-header">
                        <i class="bi bi-list"></i> Announcements
                    </div>
                    <announcement-dashboard :org_id={{ Session::get('org_id') }}
                        :school_year_session={{ Session::get('school_year') }}>
                    </announcement-dashboard>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 mb-4">
                <div id="calendar">
                    <dashboard-calendar :org_id={{ Session::get('org_id') }}
                        :school_year_session={{ Session::get('school_year') }}>
                    </dashboard-calendar>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('custom-script')
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.js"></script>
    <script></script>
@endsection

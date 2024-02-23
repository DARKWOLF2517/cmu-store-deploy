@extends('layouts.main_layout')
@section('custom-title')
    <title> Student Dashboard</title>
@endsection
@section('main-content')
    <link href="/custom_css/SODashboard.css" rel="stylesheet">

    <div class="row">
        <div class="col mt-3">
            <div class="welcome-card-student">
                <div class="welcome-text">
                    <p>Welcome, {{ Auth::user()->name }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col mt-3">
        <div class="row">
            <div class="col-lg-4 col-md-12 mb-2">
                <div class="timeline-schedule">
                    <div class="timeline-header">
                        <i class="bi bi-list"></i> Event Timeline
                    </div>
                    <event-dashboard :organization_id={{ Session::get('org_id') }}
                        :school_year_session={{ Session::get('school_year') }}>

                    </event-dashboard>
                    {{-- <div class="timeline-body">
                            <ul class="sessions">
                                <li>
                                    <div class="date">October 07, 2023</div>
                                    <small>Acquaintance Party</small>
                                </li>
                                <li>
                                    <div class="date">September 30, 2023</div>
                                    <small>Bayanihan</small>
                                </li>
                                <li>
                                    <div class="date">September 20, 2023</div>
                                    <small>Palaro</small>
                                </li>
                                <li>
                                    <div class="date">July 30, 2023</div>
                                    <small>General Assembly</small>
                                </li>
                                <li>
                                    <div class="date">July 30, 2023</div>
                                    <small>General Assembly</small>
                                </li>
                            </ul>
                        </div> --}}
                </div>
            </div>

            <div class="col-lg-4 col-md-12 mb-3">
                <div class="announcement">
                    <div class="announcement-header">
                        <i class="bi bi-list"></i> Announcements
                    </div>
                    {{-- <div class="announcement-list">
                            <div class="announcement-card">
                                <span class="Organization"> <b>CSCo</b></span>
                                <div class="date-time-posted">
                                    <span class="date-time-uploaded"><i><small>09/30/2023 - 9:00 AM</small></i></span>
                                </div>
                                <div class="announcement-description">Naay Bayanihan Way labot free fines.</div>
                            </div>
                            <div class="announcement-card">
                                <span class="Organization"> <b>CSCo</b></span>
                                <div class="date-time-posted">
                                    <span class="date-time-uploaded"><i><small>09/30/2023 - 9:00 AM</small></i></span>
                                </div>
                                <div class="announcement-description">Naay Bayanihan Way labot free fines.</div>
                            </div>
                            <div class="announcement-card">
                                <span class="Organization"> <b>CSCo</b></span>
                                <div class="date-time-posted">
                                    <span class="date-time-uploaded"><i><small>09/30/2023 - 9:00 AM</small></i></span>
                                </div>
                                <div class="announcement-description">Naay Bayanihan Way labot free fines.</div>
                            </div>
                            <div class="announcement-card">
                                <span class="Organization"> <b>CSCo</b></span>
                                <div class="date-time-posted">
                                    <span class="date-time-uploaded"><i><small>09/30/2023 - 9:00 AM</small></i></span>
                                </div>
                                <div class="announcement-description">Naay Bayanihan Way labot free fines.</div>
                            </div>
                        </div> --}}
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

@extends('layouts.main_layout')
@section('custom-title')
  <title> Dashboard</title>
@endsection
@section('custom-style')
    <link href="{{ asset('/custom_css/SODashboard.css') }}" rel="stylesheet">
@endsection

@section('main-content')

        <div class="row">
            <div class="col mt-2">
                <div class="welcome-card" style="height: 40vh !important;">
                    <div class="welcome-text">
                        <p>{{Session::get('org_name')}}</p>
                    </div>
                </div>
            </div>
        </div>
            <div class="row mt-2">
                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="timeline-schedule" style="height: 55vh !important; max-height: 55vh !important;">
                        <div class="timeline-header">
                            <i class="bi bi-list"></i> Event Timeline
                        </div>
                    <event-dashboard
                        :organization_id =  {{Session::get('org_id')}}
                        :school_year_session = {{Session::get('school_year')}}
                        >

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

                <div class="col-lg-4 col-md-6 mb-2" >
                    <div class="announcement" style="height: 55vh !important; max-height: 55vh !important;">
                        <div class="announcement-header">
                            <i class="bi bi-list"></i> Announcement
                        </div>

                        <div class="announcement-list">
                            <div class="Message-IfEmpty">
                                <i class="icon 	fas fa-bullhorn" id="icon-message"></i>
                                <p class="empty-schedule">Announcements show up here</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 mb-2" >
                    <div id="calendar" style="height: 55vh !important; max-height: 55vh !important;">
                        <dashboard-calendar
                            :org_id = {{Session::get('org_id')}}
                            :school_year_session = {{Session::get('school_year')}}
                        >
                        </dashboard-calendar>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('custom-script')
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.js"></script>
<script>


        // document.addEventListener('DOMContentLoaded', function() {
        //     var calendarEl = document.getElementById('calendar');

        // var calendar = new FullCalendar.Calendar(calendarEl, {
        //     initialView: 'dayGridMonth',
        //     editable: true,
        //     eventSources: [
        //         {
        //         events: [
        //             {
        //             title: 'Meeting',
        //             start: '2023-09-19T10:00:00',
        //             end: '2023-09-19T12:00:00',
        //             backgroundColor: '#007bff',
        //             borderColor: '#007bff'
        //             },
        //             {
        //             title: 'Appointment',
        //             start: '2023-08-20T14:00:00',
        //             end: '2023-08-20T15:30:00',
        //             backgroundColor: '#28a745',
        //             borderColor: '#28a745'
        //             },
        //             {
        //             title: 'Deadline',
        //             start: '2023-08-22T08:00:00',
        //             end: '2023-08-22T18:00:00',
        //             backgroundColor: '#dc3545',
        //             borderColor: '#dc3545'
        //             }
        //             // Add more events with different colors as needed
        //         ],
        //         }
        //     ],

        //     eventClick: function(info) {
        //         console.log('askjdfkjsd')
        //         // Display event details in the modal
        //         document.getElementById('eventTitle').textContent = info.event.title;
        //         document.getElementById('eventStart').textContent = info.event.start;
        //         document.getElementById('eventEnd').textContent = info.event.end;

        //         // Show the modal
        //         var modal = new bootstrap.Modal(document.getElementById('eventModal'));
        //         modal.show();
        //     },
        //     });

        //     calendar.render();
        // });
</script>

@endsection

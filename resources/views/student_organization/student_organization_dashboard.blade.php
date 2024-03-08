@extends('layouts.main_layout')

@section('custom-title')
    <title> Dashboard</title>
@endsection
@section('custom-style')
    <link href="{{ asset('/custom_css/SODashboard.css') }}" rel="stylesheet">
@endsection

@section('main-content')
    <div class="row mb-0">
        <div class="col mt-2">
            <div class="welcome-card">
                <div class="welcome-text">
                    <p>{{ Session::get('org_name') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-4 col-sm-6 ">
            <div class="statistic">
                <org-dashboard-counter :org_id={{ Session::get('org_id') }}
                    :school_year_session={{ Session::get('school_year') }} card_label="Members"
                    target_route="view_org_total_members" icons="fas fa-users card-icon"></org-dashboard-counter>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 ">
            <div class="statistic">
                <org-dashboard-counter :org_id={{ Session::get('org_id') }}
                    :school_year_session={{ Session::get('school_year') }} card_label="Events" target_route="events_count"
                    icons="fas fa-clock card-icon ongoing-events"></org-dashboard-counter>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 ">
            <div class="statistic">

                <org-dashboard-counter :org_id={{ Session::get('org_id') }}
                    :school_year_session={{ Session::get('school_year') }} card_label="Total Payments"
                    target_route="total_paid_accountabilities"
                    icons="fas fa-check card-icon completed-events"></org-dashboard-counter>
            </div>
        </div>
    </div>

    <div class="row mb-0 overflow-hidden" >
        <div class="col-lg-4 col-md-6 mb-2">
            <div class="timeline-schedule">
                <div class="timeline-header">
                    <i class="bi bi-list"></i> Event Timeline
                </div>
                <event-dashboard :organization_id={{ Session::get('org_id') }}
                    :school_year_session={{ Session::get('school_year') }}>

                </event-dashboard>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-2">
            <div class="announcement">
                <div class="announcement-header">
                    <i class="bi bi-list"></i> Announcement
                </div>
                <announcement-dashboard :org_id={{ Session::get('org_id') }}
                    :school_year_session={{ Session::get('school_year') }}>

                </announcement-dashboard>
            </div>
        </div>

        <div class="col-lg-4 col-md-12 mb-2">
            <div id="calendar">
                <dashboard-calendar :org_id={{ Session::get('org_id') }}
                    :school_year_session={{ Session::get('school_year') }}>
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

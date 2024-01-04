
@extends('layouts.student_organization_navigation_bar')
<link href="/custom_css/SOAttendance.css" rel="stylesheet">

@section('main-content')

<div class="page-content-wapper">
    <div class="content">
        <div class="page-container">
        <div class="col-md breadcrumbs">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/login/org_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Organization</li>
                <li class="breadcrumb-item active" aria-current="page">Attendance</li>
                <li class="breadcrumb-item active" aria-current="page">Attendance Records</li>
              </ol>
            </nav>
        </div>
        {{-- <div class="container" id="tablecontainer">
            <h3 class="mt-2">
                <i class="fas fa-list"></i> Attendance Records
            </h3>
            <div class="d-flex flex-wrap">
                <div class="card mb-2 mx-2">
                    <div class="card-header">Date: June 2, 2023</div>
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title">Event Name: Freshmen Orientation</h5>
                        </div>
                        <div class="ml-auto">
                            <a class="btn view-button" href="/student_organization_attendance_record">
                                <i class="fas fa-chevron-right button-icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card mb-2 mx-2">
                    <div class="card-header">Date: June 2, 2023</div>
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title">Event Name: Freshmen Orientation</h5>
                        </div>
                        <div class="ml-auto">
                            <a class="btn view-button" href="/student_organization_attendance_record">
                                <i class="fas fa-chevron-right button-icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card mb-2 mx-2">
                    <div class="card-header">Date: June 2, 2023</div>
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title">Event Name: Freshmen Orientation</h5>
                        </div>
                        <div class="ml-auto">
                            <a class="btn view-button" href="/student_organization_attendance_record">
                                <i class="fas fa-chevron-right button-icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="mt-2">
                <div class="row head-container">
                    <div class="col-md-6 col-sm-12">
                        <div class="input-container">
                            <i class="fa fa-search"></i>
                            <input type="text" placeholder="Search Event">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end;">
                        {{-- <button class="btn sort-btn"><i class="bi bi-sort-up"></i></button> --}}
                        <div class="select-dropdown">
                            <select id="sort-select" class="form-control" style="text-align: center;">
                                <option value="">Select Semester</option>
                                <option value="option1">1st Semester 2023-2024</option>
                                <option value="option2">2nd Semester 2022-2023</option>
                                <option value="option3">1st Semester 2022-2023</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mt-4">
                <h4><i class="fas fa-list"></i> Attendance Records</h4>
            </div>
                <div class="col" id="record-container">

                        <attendance-record
                        organization_id = {{Session::get('org_id')}}
                        >

                        </attendance-record>
                        {{-- <div class="record-card">
                            <div class="record-date-container"><span class="event-date">August 31, 2023</span></div>
                            <div class="record-title">Event 1</div>
                            <div class="record-description">Number of Attendance recorded: 2</div>
                            <a class="view-button" href="/student_organization_attendance_record"><i class="fas fa-chevron-right button-icon"></i></a>
                        </div>
                        <div class="record-card">
                            <div class="record-date-container"><span class="event-date">August 31, 2023</span></div>
                            <div class="record-title">Event 1</div>
                            <div class="record-description">Number of Attendance recorded: 2</div>
                            <a class="view-button" href="/student_organization_attendance_record"><i class="fas fa-chevron-right button-icon"></i></a>
                        </div>
                        <div class="record-card">
                            <div class="record-date-container"><span class="event-date">August 31, 2023</span></div>
                            <div class="record-title">Event 1</div>
                            <div class="record-description">Number of Attendance recorded: 2</div>
                            <a class="view-button" href="/student_organization_attendance_record"><i class="fas fa-chevron-right button-icon"></i></a>
                        </div>
                        <div class="record-card">
                            <div class="record-date-container"><span class="event-date">August 31, 2023</span></div>
                            <div class="record-title">Event 1</div>
                            <div class="record-description">Number of Attendance recorded: 2</div>
                            <a class="view-button" href="/student_organization_attendance_record"><i class="fas fa-chevron-right button-icon"></i></a>
                        </div>
                        <div class="record-card">
                            <div class="record-date-container"><span class="event-date">August 31, 2023</span></div>
                            <div class="record-title">Event 1</div>
                            <div class="record-description">Number of Attendance recorded: 2</div>
                            <a class="view-button" href="/student_organization_attendance_record"><i class="fas fa-chevron-right button-icon"></i></a>
                        </div>
                        <div class="record-card">
                            <div class="record-date-container"><span class="event-date">August 31, 2023</span></div>
                            <div class="record-title">Event 1</div>
                            <div class="record-description">Number of Attendance recorded: 2</div>
                            <a class="view-button" href="/student_organization_attendance_record"><i class="fas fa-chevron-right button-icon"></i></a>
                        </div> --}}




                        <!-- Add more event cards here -->
                    </div>
                </div>

            </div>
    </div>
</div>




      {{-- <!-- View Attendance Modal -->
      <div class="modal fade" id="viewAttendanceModal" tabindex="-1" aria-labelledby="viewAttendanceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="viewAttendanceModalLabel">View Attendance</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Attendance details go here.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div> --}}





@endsection

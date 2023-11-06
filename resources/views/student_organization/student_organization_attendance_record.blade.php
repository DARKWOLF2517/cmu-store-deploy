
@extends('layouts.student_organization_navigation_bar')
@section('main-content')
<div class="content">
    <div class="container">
        <div class="container breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/login/org_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Organization</li>
                <li class="breadcrumb-item"><a href="/student_organization_attendance">Attendance</a></li>
                <li class="breadcrumb-item active" aria-current="page">Attendance Record</li>
                </ol>
            </nav>
        </div>
        
                <show-student-attendance
                    event_id = {{$event_id}}
                    organization_id = {{Session::get('org_id')}}
                >

                </show-student-attendance>
</div>
</div>

{{-- <div class="content">
    <div class="container">
        <div class="container breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/login/org_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Organization</li>
                <li class="breadcrumb-item"><a href="/student_organization_attendance">Attendance</a></li>
                <li class="breadcrumb-item active" aria-current="page">Attendance Record</li>
                </ol>
            </nav>
        </div>

        <div class="container" id="tablecontainer">

            <div class="row head-container">
                <div class="col-md-6 col-sm-12">
                    <div class="input-container">
                        <i class="fa fa-search"></i>
                        <input type="text" placeholder="Search Event">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end;">
                    <button class="btn sort-btn"><i class="bi bi-sort-up"></i></button>
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

            <h4> <i class="fas fa-list mt-2"></i> Attendance Record</h4>
            <div class="container" id="table-container">
                <div class=" student-buttons d-flex justify-content-end">
                    <div class="btn-group" role="group">
                        <button class="btn me-2" id="add-student-list-button">
                            <i class="fas fa-print"></i> Print Recorded Attendance
                        </button>
                        <button class="btn me-2" id="add-student-button">
                            <i class="fas fa-download"></i> Download Recorded Attendance
                        </button>
                    </div>
                </div>
                <div class="scroll-pane">
            <h5 id="Eventtitle"> Event: </h5>
            <p>Date: </p>
            <table  id="accountabilities-table">
                <thead>
                    <tr>
                        <th class="sortable-header">Student ID</th>
                        <th class="sortable-header">Student Name</th>
                        <th class="sortable-header">Log in</th>
                        <th class="sortable-header">Log out</th>
                        <th class="sortable-header">Log in</th>
                        <th class="sortable-header">Log out</th>
                        <th class="sortable-header">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>2023-05-01</td>
                    <td>John Smith</td>
                    <td>present</td>
                    <td>present</td>
                    <td>absent</td>
                    <td>absent</td>
                    <td>
                        <button class="edit-button ellipsis-button" onclick="openEditModal(this)">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="delete-button ellipsis-button">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                    </tr>

                </tbody>
            </table>
            </div>
            <div class="pagination">
                <button id="first-page-button" onclick="goToPage(1)" disabled>&lt;&lt;</button>
                <button id="previous-page-button" onclick="previousPage()" disabled>&lt; Previous</button>
                <span id="pagination-numbers"></span>
                <button id="next-page-button" onclick="nextPage()">Next &gt;</button>
                <button id="last-page-button" onclick="goToPage(pageCount)">&gt;&gt;</button>
            </div>
        </div>
        </div>
    </div> --}}

@endsection

@extends('layouts.student_navigation_bar')
@section('main-content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

<link href="/custom_css/StudentAccountabilities.css" rel="stylesheet">
<div class="content">
    <div class="container">
        <div class="container breadcrumbs">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/login/org_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Organization</li>
                <li class="breadcrumb-item active" aria-current="page">Accountabilities</li>
            </ol>
            </nav>
        </div>
        <div class="mt-2">
            <div class="row head-container">
                <div class="col-md-6 col-sm-12">
                    <h4><i class="fas fa-bars"></i> Attendance</h4>
                </div>
                <div class="col-md-6 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end;">
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
    <div class="scroll-attendance">
        <student-event-card
        organization_id = {{Session::get('org_id')}}
        student_id = {{Auth::id()}}
        >

        </student-event-card>



            {{-- <div class="container" id="tablecontainer">
                <h4> Event name: Acquaintance Party</h4>
                <h6> Number of Days: 1</h6>
                <h6> Total number of Attendance made: 1</h6>
                <table class="mt-4">
                    <thead >
                        <tr>
                            <th class="sortable-header center" colspan="5">September 2, 2023</th>
                        </tr>
                        <tr>
                            <th class="sortable-header">Log in - 7:00 AM</th>
                            <th class="sortable-header"> Log out - 11:00 AM</th>
                            <th class="sortable-header"> Evaluation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="present">Present</td>
                            <td class="present">Present</td>
                            <td><a href="/student_evaluationform"><button class="btn btn-warning" >Evaluate now</button></a></td>
                        </tr>
                    </tbody>
                </table>
                </div> --}}
        </div>
    </div>
</div>
</div>
@endsection

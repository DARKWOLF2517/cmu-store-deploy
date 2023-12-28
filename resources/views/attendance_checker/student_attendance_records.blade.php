@extends('layouts.attedance_checker_navigation_bar')

@section('custom-style')
<link href="/custom_css/SOAttendance.css" rel="stylesheet">
@endsection
@section('main-content')

<div class="content">
    <div class="container">
        <div class="container breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/login/org_dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item">Attendance Checker</li>
                    <li class="breadcrumb-item active" aria-current="page">Attendance</li>
                    <li class="breadcrumb-item active" aria-current="page">Attendance Records</li>
                </ol>
            </nav>
        </div>
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
                    <div class="recorded-event-cards">
                        <attendance-record
                        organization_id = {{Session::get('org_id')}}
                        >
                        </attendance-record>
                    </div>
                </div>

            </div>
        </div>





@endsection

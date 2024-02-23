@extends('layouts.main_layout')
@section('custom-title')
  <title> Student Profile</title>
@endsection
@section('custom-style')
<link href="{{ asset('custom_css/studentProfile.css') }}" rel="stylesheet">
@endsection

@section('main-content')

        <div class="col breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="student_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student</li>
                <li class="breadcrumb-item active" aria-current="page">Student Profile</li>
                </ol>
            </nav>
        </div>
        <div class="col" style="height: 85vh !important;">
        <student-profile
        user_id = {{Auth::id()}}
        user_org = {{Session::get('org_id')}}
        ></student-profile>
    </div>
        {{-- <div class="row">
            <div class="col-md-3">
                <div class="qr-code">
                    <img src="https://via.placeholder.com/150" alt="profile photo">

                    {{QrCode::generate(Auth::id()) }}
                    <h5>Queen Bahay</h5>
                    <small>2020202020</small>
                </div>
            </div>


            <div class="col-md-9">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true"><b>Profile</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="organization-tab" data-toggle="tab" href="#organization" role="tab" aria-controls="organization" aria-selected="false"><b>Organization</b></a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- Profile Tab Content -->
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="col">
                            <div class="row student-details">
                                <div class="student-info">
                                    <h3>Student Information</h3>
                                    <p><b>Full name: </b> <span id="full-name">John Doe</span></p>
                                    <p><b>Year level: </b> <span id="year-level">3rd year</span></p>
                                    <p><b>College: </b> <span id="college">College of Arts and Sciences</span></p>
                                    <p><b>Department: </b> <span id="department"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Clubs Tab Content -->
                    <div class="tab-pane fade" id="organization" role="tabpanel" aria-labelledby="organization-tab">
                        <h3>Organizations</h3>
                        <ul>
                            <li><b>SSC</b> Supreme Student Council</li>
                            <li><b>SSC</b> Supreme Student Council</li>
                            <li><b>SSC</b> Supreme Student Council</li>
                            <!-- Add more club items here -->
                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}

@endsection

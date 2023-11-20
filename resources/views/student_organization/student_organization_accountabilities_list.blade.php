@extends('layouts.student_organization_navigation_bar')

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
                <li class="breadcrumb-item active" aria-current="page">Membership Fee List</li>
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

                <div class="col-md-4 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end; margin-right: 20px;">
                    <div class="select-dropdown">
                        <!-- First dropdown -->
                        <select id="sort-select" class="form-control" style="text-align: center;">
                            <option value="" disabled selected><i class="fas fa-filter"></i> Sort by</option>
                            <option value="fines">Fines</option>
                            <option value="membership_fee">Membership Fee</option>
                        </select>
                    </div>

                    {{-- <button class="btn sort-btn"><i class="fas fa-filter"></i></button> --}}

                    <div class="select-dropdown" id= "semester-btn" style="margin-left: 20px; width: 270px;">
                        <!-- Second dropdown -->
                        <select id="sort-select" class="form-control" style="text-align: center; ">
                            <option value="">Select Semester</option>
                            <option value="option1">1st Semester 2023-2024</option>
                            <option value="option2">2nd Semester 2022-2023</option>
                            <option value="option3">1st Semester 2022-2023</option>
                        </select>
                    </div>
                </div>


            <h4> <i class="fas fa-list mt-2"></i>  Student Accountabilities</h4>
            <show-accountabilities-list
            org_id = {{Session::get('org_id')}}
            >

            </show-accountabilities-list>
        </div>
    </div>
</div>

@endsection

@section('custom-script')
<!-- Bootstrap JavaScript -->
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

@endsection
        
@extends('layouts.main_layout')

@section('custom-title')
  <title> Evaluation Answered Results</title>
@endsection
@section('custom-style')
<link href="/custom_css/StudentAccountabilities.css" rel="stylesheet">
@endsection
@section('main-content')

        <div class="col breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/org_dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item">Student Organization</li>
                    <li class="breadcrumb-item active" aria-current="page">Evaluation</li>
                    <li class="breadcrumb-item active" aria-current="page">Evaluation Results Table</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col ">
                <div class="input-container mt-2">
                    <i class="fa fa-search"></i>
                    <input type="text" placeholder="Search Student">
                </div>
            </div>
            <div class="col" style="display: flex; align-items: center; justify-content: flex-end; gap: 20px;">
                <div class="select-dropdown" id="semester-btn" style="margin-left: 20px; width: 60%;">
                    <!-- First dropdown -->
                    <select id="sort-select-semester" class="form-control" style="text-align: center;">
                        <option value="0" disabled selected>Select Semester</option>
                        <option >1st</option>
                    </select>
                </div>
                <div class="select-dropdown">
                    <!-- Second dropdown -->
                    <select id="sort-select-accountability" class="form-control" style="text-align: center;" v-model="select_accountability">
                        <option value="" disabled selected><i class="fas fa-filter"></i> Sort by</option>
                        <option value="responded">Responded</option>
                        <option value="notyet">Not yet Responded</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-list mt-2"></i> List of Student that Responded</h4>
                <div class="student-buttons d-flex">
                    <div class="btn-group" role="group">
                        <button class="btn me-2" id="add-student-list-button" @click="printTable">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <button class="btn me-2" id="add-student-button" @click="downloadTable">
                            <i class="fas fa-download"></i> Download
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div id="table-container">
            <div class="scroll-pane">
                <table >
                    <thead>
                        <tr>
                            <th>Student ID</th>
                        <th>Full Name</th>
                        <th>Year Level</th>
                        <th>College</th>
                        </tr>
                    </thead>
                        <tbody>
                            <tr>
                                <td> 123456789</td>
                                <td> Taylor Swift</td>
                                <td> 4th year</td>
                                <td>CISC</td>
                            </tr>
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<!-- Bootstrap JavaScript -->
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

@endsection

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
                    <h4><i class="fas fa-bars"></i> Accountabilities</h4>
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
        <div class="scroll-pane">
        <div class="container" id="accountabilities-table">
            <table  id="accountabilities-table">
                    <tr>
                        <th>Student Name</th>
                        <td><b>Taylor Swift</b></td>
                    </tr>
                    <tr>
                        <th>Membership Fee Status</th>
                        <td class="unpaid">Unpaid</td>
                    </tr>
                    <tr>
                        <th>Fines Status</th>
                        <td class="paid">Paid</td>
                    </tr>
                    <tr>
                        <th>Clearance Status</th>
                        <td class="not-cleared">Not Cleared</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

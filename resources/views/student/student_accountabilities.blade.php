@extends('layouts.main_layout')

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
@section('custom-title')
    <title>My Accountabilities</title>
@endsection
@section('custom-style')
    <link href="{{ asset('/custom_css/StudentAccountabilities.css') }}" rel="stylesheet">
@endsection
@section('main-content')
    <div class=" breadcrumbs">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/student_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student</li>
                <li class="breadcrumb-item active" aria-current="page">Accountabilities</li>
            </ol>
        </nav>
    </div>
    <div class="col" style="height: 85vh !important;">
        <show-fines :user_id={{ Auth::id() }} :name="{{ json_encode(Auth::user()->name) }}"
            :school_year_session={{ Session::get('school_year') }}>

        </show-fines>
    </div>
    {{-- <div class="mt-2">
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
                        <td class="unpaid">1000</td>
                    </tr>
                    <tr>
                        <th>Fines Status</th>
                        <td class="paid">200</td>
                    </tr>
                </table>
            </div>
        </div> --}}
@endsection

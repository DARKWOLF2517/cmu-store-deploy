@extends('layouts.main_layout')
@section('custom-title')
  <title>My Attendance</title>
@endsection
@section('custom-style')
<style>
    .evaluation-list {
    max-height: 70vh;
    height: 70vh;
    }
.evaluation-cards-list {
    display: flex;
    flex-wrap: wrap;
    overflow-y: auto;
    overflow-x: hidden;
    max-height: 70vh;
    height: 70vh;
  }

  .evaluation-attendance-card{
    background-color: #ffffff;
    border-radius: 8px;
    margin: 10px;
    padding: 10px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    box-shadow: rgba(0, 0, 0, 0.05) 0px 1px 2px 0px;
    width: calc(33.33% - 20px);
    height: auto;
    max-height: 230px;
  }
  .bottom-right-content {
    position: absolute;
    bottom: 0;
    right: 0;

}
.circular-image {
    border-radius: 50%;
}
.posted-by-title{
    padding: 5px;
 }

/* Add your existing styles here */

@media (max-width: 767px) {
    .evaluation-attendance-card {
        width: 100%;
        margin-bottom: 15px;
        height: 250px;
    }

    .card-body {
        padding: 15px;
    }
    h5{
        font-size: 15px;
    }
    .btn{
        font-size: 13px !important;
    }

}

</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
@endsection
@section('main-content')
        <div class="breadcrumbs">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/student_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student</li>
                <li class="breadcrumb-item active" aria-current="page">Evaluation</li>
            </ol>
            </nav>
        </div>
        {{-- <div class="mt-2">
            <div class="row head-container">
                <div class="col-md-6 col-sm-12">
                    <h4><i class="fas fa-list mt-2"></i>  Evaluation</h4>
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
        </div> --}}
{{--
        <student-event-card
        organization_id = {{Session::get('org_id')}}
        student_id = {{Auth::id()}}
        >

        </student-event-card> --}}



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

@endsection

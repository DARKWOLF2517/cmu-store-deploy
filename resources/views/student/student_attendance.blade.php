@extends('layouts.student_navigation_bar')
@section('custom-style')
<style>
    .evaluation-list {
    max-height: 60vh;
    height: 60vh;
    }
.evaluation-cards-list {
    display: flex;
    flex-wrap: wrap;
    overflow-y: auto;
    overflow-x: hidden;
    max-height: 65vh;
    height: 65vh;
  }

  .evaluation-attendance-card{
    background-color: #ffffff;
    border-radius: 8px;
    margin: 10px;
    padding: 10px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    width: calc(33.33% - 20px);
height: 33vh;
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
        width: 100%; /* Make the cards full width on smaller screens */
        margin-bottom: 15px; /* Add some spacing between cards */
        height: 250px;
    }

    .card-body {
        padding: 15px; /* Add padding to the card body for better spacing */
    }
    h5{
        font-size: 15px;
    }

}

</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
@endsection
@section('main-content')
<div class="page-content-wapper">
    <div class="content">
        <div class="page-container">
        <div class="breadcrumbs">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/login/org_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student</li>
                <li class="breadcrumb-item active" aria-current="page">Evaluation</li>
            </ol>
            </nav>
        </div>
        <div class="mt-2">
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
        </div>

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

@endsection

@extends('layouts.main_layout')
@section('custom-title')
    <title> Evaluation List</title>
@endsection
@section('custom-style')
    <link href="/custom_css/evaluation.css" rel="stylesheet">
    {{-- <style>
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

</style> --}}
@endsection
@section('main-content')
    <div class="breadcrumbs">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="student_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student</li>
                <li class="breadcrumb-item active" aria-current="page">Evaluation</li>
            </ol>
        </nav>
    </div>
    <h3 class="mt-2"><i class="fas fa-list"></i> Evaluation</h3>

    <div class="col" style="height: 80vh !important;">
        <student-event-card organization_id={{ Session::get('org_id') }} student_id={{ Auth::id() }}>

        </student-event-card>
    </div>

    {{--
    </div>
    </div> --}}
@endsection

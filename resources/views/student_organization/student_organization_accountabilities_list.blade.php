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


            <show-accountabilities-list
            :org_id = {{Session::get('org_id')}} />

          
        </div>
    </div>
</div>

@endsection

@section('custom-script')
<!-- Bootstrap JavaScript -->
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

@endsection
        
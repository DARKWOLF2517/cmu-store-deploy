@extends('layouts.student_organization_navigation_bar')
@section('main-content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

<link href="/custom_css/StudentAccountabilities.css" rel="stylesheet">
<div class="page-content-wapper">
    <div class="content">
        <div class="page-container">
            <div class="col breadcrumbs">
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/login/org_dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item">Student Organization</li>
                    <li class="breadcrumb-item active" aria-current="page">Set Accountabilities</li>
                </ol>
                </nav>
            </div>
            <h4 class="mt-3"> <i class="fas fa-list"></i> Organization Accountabilities</h4>
            <div class="alert alert-info mt-2" role="alert">
                <b><i class="fas fa-info"></i> Note!</b>  This is where the student organization accountability is set. If you haven't set anything yet, please click the button to set accountabilities.
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <set-accountabilities
            :org_id = {{Session::get('org_id')}}
            :school_year_session = {{Session::get('school_year')}}
            >

            </set-accountabilities>
        </div>
    </div>
</div>

@endsection
        <!-- Bootstrap JavaScript -->
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
@section('custom-script')


@endsection

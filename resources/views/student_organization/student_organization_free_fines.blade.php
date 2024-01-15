@extends('layouts.student_organization_navigation_bar')

@section('custom-style')
<link href="/custom_css/StudentAccountabilities.css" rel="stylesheet">
@endsection

@section('main-content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<div class="page-content-wapper">
    <div class="content">
        <div class="page-container">
        <div class="col breadcrumbs">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/org_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Organization</li>
                <li class="breadcrumb-item active" aria-current="page">Accountabilities</li>
                <li class="breadcrumb-item active" aria-current="page">Set Free Fines</li>
            </ol>
            </nav>
        </div>
        <div class="mt-2">

                <set-free-fines
                    :org_id = {{Session::get('org_id')}}
                    :school_year_session = {{Session::get('school_year')}}
                    />
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-script')
<!-- Bootstrap JavaScript -->
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

@endsection

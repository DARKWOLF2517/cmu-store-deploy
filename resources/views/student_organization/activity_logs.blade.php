@extends('layouts.main_layout')

@section('custom-title')
    <title> Accountabilities List</title>
@endsection

@section('custom-style')
    <link href="{{ asset('/custom_css/stylesheet.css') }}" rel="stylesheet">
        <link href="{{ asset('/custom_css/tables.css') }}" rel="stylesheet">
@endsection

@section('main-content')
    <div class="col breadcrumbs">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/org_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Organization</li>
                <li class="breadcrumb-item active" aria-current="page">Activity logs</li>
            </ol>
        </nav>
    </div>
    <div class="mt-2">
        <div class="row">
            <show-logs
                :school_year_session={{ Session::get('school_year') }} />
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <!-- Bootstrap JavaScript -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
@endsection

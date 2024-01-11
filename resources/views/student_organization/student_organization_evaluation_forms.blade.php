
@extends('layouts.student_organization_navigation_bar')
@section('main-content')
<link href="/custom_css/evaluation.css" rel="stylesheet">
<div class="page-content-wapper">
    <div class="content">
        <div class="page-container">
        <div class="col breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/login/org_dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item">Student Organization</li>
                    <li class="breadcrumb-item">Evaluation</li>
                    <li class="breadcrumb-item " aria-current="page">Evaluation Forms</li>
                </ol>
            </nav>
        </div>
        <evaluation-form-list
                organization_id = {{Session::get('org_id')}}
                :school_year_session = {{Session::get('school_year')}}
        ></evaluation-form-list>
    </div>
</div>
</div>

@endsection

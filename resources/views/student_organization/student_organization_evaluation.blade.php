
@extends('layouts.student_organization_navigation_bar')
@section('main-content')
<link href="/custom_css/evaluation.css" rel="stylesheet">
<div class="content">
    <div class="container">
        <div class="container breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/login/org_dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item">Student Organization</li>
                    <li class="breadcrumb-item active" aria-current="page">Evaluation</li>
                </ol>
            </nav>
        </div>
                <evaluation-list
                organization_id = {{Session::get('org_id')}}
                ></evaluation-list>
    </div>
</div>

@endsection

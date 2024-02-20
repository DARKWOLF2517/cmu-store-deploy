@extends('layouts.main_layout')

@section('custom-title')
  <title> Evaluation</title>
@endsection
@section('main-content')
<link href="/custom_css/evaluation.css" rel="stylesheet">

        <div class="col breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/org_dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item">Student Organization</li>
                    <li class="breadcrumb-item active" aria-current="page">Evaluation</li>
                </ol>
            </nav>
        </div>
                <evaluation-list
                organization_id = {{Session::get('org_id')}}
                :school_year_session = {{Session::get('school_year')}}
                ></evaluation-list>


@endsection

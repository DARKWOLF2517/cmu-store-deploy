@extends('layouts.main_layout')

@section('custom-title')
    <title> Free Fines</title>
@endsection
@section('custom-style')
    <link href="{{ asset('/custom_css/evaluation.css') }}" rel="stylesheet">
@endsection

@section('main-content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

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
        <set-free-fines :org_id={{ Session::get('org_id') }} :school_year_session={{ Session::get('school_year') }}
            :user_school_year={{ Session::get('user_school_year') }} />
    </div>
    </div>
@endsection

@section('custom-script')
@endsection

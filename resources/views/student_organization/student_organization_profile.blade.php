@extends('layouts.main_layout')

@section('custom-title')
    <title> Student Organization Profile</title>
@endsection
@section('custom-style')
    <link href="{{ asset('/custom_css/studentProfile.css') }}" rel="stylesheet">
@endsection
@section('main-content')
    <org-profile :org_id={{ Session::get('org_id') }} :user_id={{ Auth::id() }}
        :school_year_session={{ Session::get('school_year') }}>

    </org-profile>
@endsection
@section('custom-script')
@endsection

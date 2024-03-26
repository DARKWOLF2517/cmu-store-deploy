@extends('layouts.main_layout')
@section('custom-title')
    <title> Evaluation Form</title>
@endsection
@section('custom-style')
    <link href="{{ asset('/custom_css/studentEvaluation.css') }}" rel="stylesheet">
@endsection
@section('main-content')
    <div class=" mt-6 p-2" id="evaluation-form">
        <student-evaluation-form-summary user_id={{ Auth::id() }} event_id={{ $event_id }}
            org_id={{ Session::get('org_id') }} evaluation_form_id={{ $evaluation_form_id }}>

        </student-evaluation-form-summary>
    @endsection

    @section('custom-script')
    @endsection

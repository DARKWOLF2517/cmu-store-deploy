@extends('layouts.main_layout')

@section('custom-title')
    <title> Evaluation Results</title>
@endsection

@section('custom-style')
    <link id="load-css-0" rel="stylesheet" type="text/css" href="https://www.gstatic.com/charts/51/css/core/tooltip.css">
    <link id="load-css-1" rel="stylesheet" type="text/css" href="https://www.gstatic.com/charts/51/css/util/util.css">
    <link href="{{ asset('/custom_css/evaluation.css') }}" rel="stylesheet">
@endsection
@section('main-content')
    <div class=" breadcrumbs">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/org_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Organization</li>
                <li class="breadcrumb-item"><a href="/student_organization_evaluation">Evaluation</a></li>
                <li class="breadcrumb-item active" aria-current="page">Evaluation Results</li>
            </ol>
        </nav>
    </div>
    <evaluation-result event_id={{ $event_id }} evaluation_id={{ $evaluation_form_id }}>
    </evaluation-result>
@endsection

@section('custom-script')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="https://www.gstatic.com/charts/51/loader.js"></script>
    <script type="text/javascript" charset="UTF-8"
        src="https://www.gstatic.com/charts/51/js/jsapi_compiled_default_module.js"></script>
    <script type="text/javascript" charset="UTF-8"
        src="https://www.gstatic.com/charts/51/js/jsapi_compiled_graphics_module.js"></script>
    <script type="text/javascript" charset="UTF-8" src="https://www.gstatic.com/charts/51/js/jsapi_compiled_ui_module.js">
    </script>
    <script type="text/javascript" charset="UTF-8"
        src="https://www.gstatic.com/charts/51/js/jsapi_compiled_corechart_module.js"></script>


    <!-- Add jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@endsection

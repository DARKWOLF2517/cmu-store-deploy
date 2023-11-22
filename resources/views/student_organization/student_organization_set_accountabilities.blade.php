@extends('layouts.student_organization_navigation_bar')
@section('main-content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

<link href="/custom_css/StudentAccountabilities.css" rel="stylesheet">
<div class="content">
    <div class="container">
        <div class="container breadcrumbs">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/login/org_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Organization</li>
                <li class="breadcrumb-item active" aria-current="page">Set Accountabilities</li>
            </ol>
            </nav>
        </div>
    </div>
            <div class="container" >
                <h4> <i class="fas fa-bars"></i> Organization Accountabilities</h4>

                <div class="alert alert-info mt-4" role="alert">
                    This is where the student organization accountability is set. If you haven't set anything yet, please click the button to set accountabilities.
                </div>


                <set-accountabilities
                org_id = {{Session::get('org_id')}}
                >

                </set-accountabilities>

                {{-- <button>sdfdsf</button>
                <div class="row">

                    <!-- Card 1 -->
                    <div class="col-md-6 col-12">
                        <div class="membershipfee-card">
                            <h2>Membership Fee</h2>
                            <h4>Php 0.00</h4>
                            <p class="membershipfee-description">1 semester</p>
                            <button class="btn btn-primary" id="btn-accountabilities" data-bs-toggle="modal" data-bs-target="#membershipFeeModal">Set Membership Fee</button>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-md-6 col-12">
                        <div class="fines-card">
                            <h2>Fines Fee</h2>
                            <h4>Php 0.00</h4>
                            <p class="fines-description">Per Log</p>
                            <button class="btn btn-primary" id="btn-accountabilities" data-bs-toggle="modal" data-bs-target="#finesModal">Set Fines</button>
                        </div>
                    </div>

                </div> --}}
            </div>

            {{-- <!-- Membership Fee Modal -->
            <div class="modal fade" id="membershipFeeModal" tabindex="-1" aria-labelledby="membershipFeeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="membershipFeeModalLabel">Edit Membership Fee</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add form elements for editing membership fee -->
                            <label for="membershipFeeInput" class="form-label">Membership Fee:</label>
                            <input type="text" class="form-control" id="membershipFeeInput">
                            <label for="membershipFeeDescriptionInput" class="form-label mt-2">Description:</label>
                            <input type="text" class="form-control" id="membershipFeeDescriptionInput">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="saveMembershipFeeBtn">Save changes</button>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Fines Modal -->
            {{-- <div class="modal fade" id="finesModal" tabindex="-1" aria-labelledby="finesModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="finesModalLabel">Edit Fines</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add form elements for editing fines -->
                            <label for="finesInput" class="form-label">Fines:</label>
                            <input type="text" class="form-control" id="finesInput">
                            <label for="finesDescriptionInput" class="form-label mt-2">Description:</label>
                            <input type="text" class="form-control" id="finesDescriptionInput">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="saveFinesBtn">Save changes</button>
                        </div>
                    </div>
                </div>
            </div> --}}
</div>
                    {{-- </div>
                    </div>
        </div> --}}

@endsection
        <!-- Bootstrap JavaScript -->
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
@section('custom-script')


@endsection

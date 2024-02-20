@extends('layouts.main_layout')

@section('custom-title')
  <title> Student Organization Profile</title>
@endsection

@section('main-content')
{{-- CSS Stylesheet link --}}
<link href="/custom_css/studentProfile.css" rel="stylesheet">
{{-- <div class="content">
    <div class="container mt-4">
        <div class="container breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/login/student_organization_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Ogranization</li>
                <li class="breadcrumb-item active" aria-current="page">Organization Profile</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="profile">
                    <img id="profileImage" src="https://via.placeholder.com/150" alt="profile photo">
                    <h5><b> CSCo</b></h5>
                    <small>College of Information Sciences and Computing Student Council</small>
                </div>
            </div>

            <div class="col-md-9">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true"><b>Profile</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="organization-tab" data-toggle="tab" href="#organization" role="tab" aria-controls="organization" aria-selected="false"><b>Organization</b></a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- Profile Tab Content -->
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="col">
                            <!-- Add an edit button on the top right -->
                            <div class="d-flex justify-content-end mb-3">
                                <button class="btn btn-light mr-2" id="editButton" data-toggle="modal" data-target="#editModal">Edit Details</button>
                                <button class="btn btn-light" id="editSemesterButton" data-toggle="modal" data-target="#editSemesterModal">Edit Semester</button>
                            </div>

                            <div class="row student-details">
                                <div class="student-org-info">
                                    <h4><b>Student Organization Information</b></h4>
                                    <h6 class="mb-2"><b>Description: </b> <span id="description">College of Information Sciences and Computing</span></h6>
                                    <h6 class="mb-2"><b>Number of Members: </b> <span id="number-of-students">550</span></h6>
                                    <h6><b>Semester: </b> <span id="number-of-students">1st Semester</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="organization" role="tabpanel" aria-labelledby="organization-tab">
                        <div class="organization-details">
                            <div class="org-officers">
                                <div class="d-flex justify-content-end mb-3">
                                    <button class="btn btn-light" data-toggle="modal" data-target="#addOfficerModal">Add officers</button>
                                    <input type="file" id="fileInput" accept=".xls, .xlsx" style="display: none;">

                                    <a class="ellipsis-button btn btn-light" href="#" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: black">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                                        <!-- option 1 -->
                                        <li><a class="dropdown-item" data-toggle="modal" data-target="#viewOfficersModal">View Officers</a></li>

                                    </ul>
                                </div>
                                <h5>Organization Officers</h5>
                                <div class="officers-list">
                                    <ul>
                                        <li>Taylor Swift - Chairperson</li>
                                        <li>Ariana Grande - Vice-Chairperson Internal</li>
                                        <li>Katy Perry - Vice-Chairperson External</li>

                                    </ul>
                                </div>
                            </div>
                            <div class="partner-organizations">
                                <div class="d-flex justify-content-end mb-3">
                                    <button class="btn btn-light" data-toggle="modal" data-target="#setPartnersModal">Set Partners</button>
                                    <a class="ellipsis-button btn btn-light" href="#" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: black">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                                        <!-- option 1 -->
                                        <li><a class="dropdown-item" data-toggle="modal" data-target="#viewPartnersModal">View Partners</a></li>

                                    </ul>
                                </div>

                                <h5>Organizations Partners</b></h5>
                                <div class="partner-org-list">
                                    <li>PASOA</li>
                                    <li>JPIA</li>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="organization" role="tabpanel" aria-labelledby="organization-tab">

                        <div class="organization-details">
                            <div class="org-officers">
                                <div class="d-flex justify-content-end mb-3">
                                    <button class="btn btn-light" data-toggle="modal" data-target="#addOfficerModal">Add officers</button>
                                </div>
                                <h3>Organization Officers</h3>
                                <ul>
                                    <li>Taylor Swift - Chairperson</li>
                                    <li>Ariana Grande - Vice-Chairperson Internal</li>
                                    <li>Katy Perry - Vice-Chairperson External</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                    <div class="col">
                        <div class="roles">
                            <div class="d-flex justify-content-between align-items-center mb-3 header">
                                <h5>Committee Members</h5>
                                <button class="btn btn-light" data-toggle="modal" data-target="#setRolesModal">Set Roles</button>
                            </div>

                            <!-- Committee Members Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th style="width: 20%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Taylor Swift</td>
                                        <td>Admin</td>
                                        <td>
                                            <!-- Add your action button here -->
                                            <button class="btn " data-toggle="modal" data-target="#editRoleModal"> <i class="fas fa-edit"></i> Edit</button>
                                            <button class="btn " data-toggle="modal" data-target="#removeUserModal"> <i class="fas fa-times"></i> Remove</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Taylor Swift</td>
                                        <td>Attendance Checker</td>
                                        <td>
                                            <!-- Add your action button here -->
                                            <button class="btn " data-toggle="modal" data-target="#editRoleModal"> <i class="fas fa-edit"></i>Edit</button>
                                            <button class="btn " data-toggle="modal" data-target="#removeUserModal"> <i class="fas fa-times"></i> Remove</button>
                                        </td>
                                    </tr>
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
    </div>
</div> --}}

            <org-profile
                :org_id = {{Session::get('org_id')}}
                :user_id = {{Auth::id()}}
                :school_year_session = {{Session::get('school_year')}}
                {{-- :college_id = {{Session::get('college_id')}} --}}
            >

            </org-profile>

@endsection
@section('custom-script')
    <!-- Add Bootstrap JS and jQuery for tab functionality -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
    {{-- <script>
        document.getElementById('edit-profile-btn').addEventListener('click', function () {
            // Clear the file input value to ensure change detection
            document.getElementById('profileImageInput').value = null;
            // Optionally, you can reset the image to its default state if needed
            // document.getElementById('profileImage').src = 'default-image.jpg';

            // Additional logic for other modal content
            // For example, you might want to clear input fields or reset other elements
            document.getElementById('editDescription').value = "";
            document.getElementById('editNumberOfStudents').value = "";
            document.getElementById('editSemester').value = "first-semester";
        });

        function updateProfileImage() {
            const input = document.getElementById('profileImageInput');
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('profileImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }

            // Optionally, you can add logic to send the updated image to the server if needed

            // Additional logic for other modal content update
            // For example, you might want to send the updated description, number of students, and semester to the server

            $('#editModal').modal('hide');
        }
    </script> --}}

@endsection

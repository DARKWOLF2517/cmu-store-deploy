@extends('layouts.student_organization_navigation_bar')

@section('main-content')
{{-- CSS Stylesheet link --}}
<link href="/custom_css/studentProfile.css" rel="stylesheet">
<div class="content">
    <div class="container mt-4">
        <div class="container breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/login/student_organization_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Ogranizatopm</li>
                <li class="breadcrumb-item active" aria-current="page">Organization Profile</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="profile">
                    <img src="https://via.placeholder.com/150" style="width: 250px; height: 250px;" alt="profile photo">
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
                                <button class="btn btn-light" id="editButton" data-toggle="modal" data-target="#editModal">Edit Details</button>
                            </div>

                            <div class="row student-details">
                                <div class="student-info">
                                    <h3><b>Student Organization Information</b></h3>
                                    <h5 class="mt-4 mb-2"><b>Description: </b> <span id="description">College of Information Sciences and Computing</span></h5>
                                    <h5 class="mb-2"><b>Number of Members: </b> <span id="number-of-students">550</span></h5>
                                    <h5><b>Semester: </b> <span id="number-of-students">1st Semester</span></h5>
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

                        <div class="roles">
                            <div class="d-flex justify-content-end mb-3">
                                <button class="btn btn-light" data-toggle="modal" data-target="#setRolesModal">Set Roles</button>
                            </div>
                            <h3>Committee Members</h3>
                            <ul>
                                <li>Taylor Swift - Admin</li>
                                <li>Taylor Swift - Attendance Checker</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
 <!-- Edit Details Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Student Details</h5>
            </div>
            <div class="modal-body">
                <label for="editDescription">Description:</label>
                <input type="text" class="form-control" id="editDescription" value="College of Information Sciences and Computing">

                <label class="mt-4" for="editNumberOfStudents">Number of Members:</label>
                <input type="text" class="form-control" id="editNumberOfStudents" value="550">

                <label class="mt-4" for="editSemester">Semester:</label>
                <select class="form-control" id="editSemester">
                    <option value="first-semester">1st Semester</option>
                    <option value="second-semester">2nd Semester</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveChangesButton">Save Changes</button>
            </div>
        </div>
    </div>
</div>

 <!-- Add officers Modal -->
 <div class="modal fade" id="addOfficerModal" tabindex="-1" role="dialog" aria-labelledby="addOfficerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOfficerModalLabel">Add Officer</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="officerName"><b>Name of Officer</b></label>
                        <input type="text" class="form-control" id="officerName" placeholder="Enter name">
                    </div>
                    <div class="form-group mt-4">
                        <label for="positionTitle"><b>Title of Position</b></label>
                        <input type="text" class="form-control" id="positionTitle" placeholder="Enter title">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary mt-2">Add Officer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Set Roles Modal -->
    <div class="modal fade" id="setRolesModal" tabindex="-1" role="dialog" aria-labelledby="setRolesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="setRolesModalLabel">Set Roles</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="selectOfficer"><b>Select Officer</b></label>
                            <select class="form-control" id="selectOfficer">
                                <option>Taylor Swift</option>
                                <option>Ariana Grande</option>
                                <option>Katy Perry</option>
                                <!-- Add other officers as needed -->
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <label for="selectRole"><b>Select Role</b></label>
                            <select class="form-control" id="selectRole">
                                <option>Admin</option>
                                <option>Attendance Checker</option>
                                <!-- Add other roles as needed -->
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary mt-2">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-script')
    <!-- Add Bootstrap JS and jQuery for tab functionality -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

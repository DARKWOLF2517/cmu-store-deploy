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
            </div>
        </div>
    </div>

    <!-- Add the modal structure for viewing partners -->
<div class="modal fade" id="viewPartnersModal" tabindex="-1" role="dialog" aria-labelledby="viewPartnersModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewPartnersModalLabel">View Partners</h5>
            </div>
            <div class="modal-body">
                <!-- Add a table to display the list of partners -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Partner Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>PASOA</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>JPIA</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                        <!-- Add more rows for additional partners if needed -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Semester Modal -->
<div class="modal fade" id="editSemesterModal" tabindex="-1" role="dialog" aria-labelledby="editSemesterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSemesterModalLabel">Edit Semester</h5>
            </div>
            <div class="modal-body">
                <!-- Semester and Academic Year Input -->
                    <label for="editYearSemester">Semester and Academic Year :</label>
                    <br>
                    <small> <b>ex: 1st Semester SY 2023-2024</b></small>
                    <input type="text" class="form-control" id="academicYearInput" placeholder="Enter Academic Year">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveSemester()">Save Changes</button>
            </div>
        </div>
    </div>
</div>
 <!-- Edit Student Details Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Student Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="editDescription">Description:</label>
                <input type="text" class="form-control" id="editDescription" value="College of Information Sciences and Computing">

                <label class="mt-4" for="editNumberOfStudents">Number of Members:</label>
                <input type="text" class="form-control" id="editNumberOfStudents" value="550">


                <label for="profileImage" class="mt-2">Change Profile Image: </label>
                <br>
                <input type="file" id="profileImageInput" accept="image/*">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateProfileImage()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- View Officer Modal -->
<div class="modal fade" id="viewOfficersModal" tabindex="-1" role="dialog" aria-labelledby="viewOfficersModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewOfficersModalLabel">View Officers</h5>
            </div>
            <div class="modal-body">

                <!-- Table with the list of officers -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Taylor Swift</td>
                            <td>Chairperson</td>
                            <td>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Ariana Grande</td>
                            <td>Vice-Chairperson Internal</td>
                            <td>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Katy Perry</td>
                            <td>Vice-Chairperson External</td>
                            <td>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal">Delete</button>
                            </td>
                        </tr>
                        <!-- Add more rows for other officers as needed -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <!-- "Delete All" button -->
                  <button class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteAllModal">Delete All</button>

            </div>
        </div>
    </div>
</div>


<!-- Delete Confirmation Modal for Individual Officer -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this officer?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteIndividualButton">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete All officers Confirmation Modal -->
<div class="modal fade" id="confirmDeleteAllModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteAllModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteAllModalLabel">Confirm Delete</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete all officers?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete All</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit set Roles Modal -->
<div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
            </div>
            <div class="modal-body">
                <form id="editRoleForm">
                    <div class="form-group">
                        <label for="editRole">Select Role:</label>
                        <select class="form-control" id="editRole" name="editRole">
                            <option value="Admin">Admin</option>
                            <option value="Attendance Checker">Attendance Checker</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" onclick="saveChanges()">Save Changes</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Remove User Modal -->
<div class="modal fade" id="removeUserModal" tabindex="-1" role="dialog" aria-labelledby="removeUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeUserModalLabel">Remove User</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to remove this user as ('role')?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" >Remove</button>
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
                            <button type="submit" class="btn btn-success mt-2">Add Officer</button>
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
                            <button type="submit" class="btn btn-success mt-2">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Set Partners Modal -->
    <div class="modal fade" id="setPartnersModal" tabindex="-1" role="dialog" aria-labelledby="setPartnersModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="setPartnersModalLabel">Set Partners</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="selectCollegeCouncil">Select College Council</label>
                            <select class="form-control" id="selectOrganization">
                                <option>CBMSO</option>
                                <option>CASCO</option>
                                <option>COEDSCO</option>
                                <option>CSCO</option>
                                <!-- Add other organizations as needed -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="selectDepartment">Select Department</label>
                            <select class="form-control" id="selectDepartment">
                                <option>JPIA</option>
                                <option>PASOA</option>
                                <option>BIMAP</option>
                                <!-- Add other departments as needed -->
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success mt-2">Save</button>
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
    <script>
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
    </script>

@endsection

<template>
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
                                <button class="btn btn-light" id="editButton" data-toggle="modal" data-target="#editModal">Edit Details</button>
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

                                <h5><b>Organizations Partners</b></h5>
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


<!-- Modal here -->



</template>
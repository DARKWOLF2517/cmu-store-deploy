<template>

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
        <div class="row height-fix">
            <div class="col-md-3 col-sm-12">
        <div class="profile">
            <img id="profileImage" src="https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png" alt="profile photo">
            <div class="profile-details mt-2">
                <h5><b> CSCo</b></h5>
                <small>College of Information Sciences and Computing Student Council</small>
            </div>
        </div>
    </div>

            <div class="col-md-9">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true"><b>Profile</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="organization-tab" data-bs-toggle="tab" href="#organization" role="tab" aria-controls="organization" aria-selected="false"><b>Organization</b></a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- Profile Tab Content -->
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="col">
                            <!-- Add an edit button on the top right -->
                            <div class="d-flex justify-content-end mb-3">
                                <button class="btn button-secondary mr-2" id="editButton" data-bs-toggle="modal" data-bs-target="#editDetailsModal">Edit Details</button>

                            </div>

                            <div class="row student-details">
                                <div class="student-org-info">
                                    <h4><b>Student Organization Information</b></h4>
                                    <h6 class="mb-2"><b>Description: </b> <span id="description">College of Information Sciences and Computing</span></h6>
                                    <h6 class="mb-2"><b>Number of Members: </b> <span id="number-of-students">550</span></h6>
                                    <h6><b>Semester and Academic Year: </b> <span id="number-of-students">1st Semester</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- For adding officer  -->
                    <div class="tab-pane fade" id="organization" role="tabpanel" aria-labelledby="organization-tab">
                        <div class="organization-details">
                            <div class="org-officers" style="width: 50%;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5><b>Organization Officers</b></h5>
                                    <button class="btn button-secondary" @click="this.addOfficerSubmit = this.addOfficer, this.clearAddOfficerData()" data-bs-toggle="modal" data-bs-target="#addOfficerModal">Add Officer</button>
                                </div>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 50%; ">Name</th>
                                            <th style="width: 40%;">Position</th>
                                            <th style="width:10%;"> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="officers in this.orgOfficers">
                                            <td>{{ officers['name'] }}</td>
                                            <td>{{ officers['position'] }}</td>
                                            <td>
                                                <a class="ellipsis-button btn btn-light" href="#" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: black">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                                                <!-- option 1 -->
                                                <li><a class="dropdown-item" @click="this.addOfficerSubmit = this.updateOfficer, this.OfficerId = officers['id'], this.officerFetchUpdate()" data-bs-toggle="modal" data-bs-target="#addOfficerModal" >Edit Officer</a></li>
                                                <!-- option 2 -->
                                                <li><a class="dropdown-item" @click="this.OfficerId = officers['id']" data-bs-toggle="modal" data-bs-target="#removeOfficerModal">Remove Officer</a></li>
                                            </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- for partner organization -->
                            <div class="partner-organizations" style="width: 50%;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5><b>Organizations Partners</b></h5>
                                    <button class="btn button-secondary" data-bs-toggle="modal" data-bs-target="#setPartnersModal">Set Partners</button>
                                </div>


                                <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="width: 50%;">Partner</th>
                                                <th style="width: 10%; "></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>JPIA</td>
                                                <td>
                                                    <!-- Ellipsis Button -->
                                                    <a class="ellipsis-button btn btn-light" href="#" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: black">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>

                                                    <!-- Dropdown Menu -->
                                                    <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                                                        <!-- option 1 -->
                                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editPartnerModal">Edit Partner</a></li>
                                                        <!-- option 2 -->
                                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#removePartnerModal">Delete Partner</a></li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="container">
    <div class="row">
        <!-- Committee Members Table -->
        <div class="col-md-6">
            <div class="roles">
                <div class="d-flex justify-content-between align-items-center mb-3 header">
                    <h5><b>Organization Roles</b></h5>
                    <button class="btn button-secondary" data-bs-toggle="modal" data-bs-target="#setRolesModal">Set Roles</button>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Name</th>
                                <th style="width: 40%;">Role</th>
                                <th style="width: 10%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Taylor Swift</td>
                                <td>Admin</td>
                                <td>
                                    <!-- Ellipsis Button -->
                                    <a class="ellipsis-button btn btn-light" href="#" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: black">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>

                                    <!-- Dropdown Menu -->
                                    <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                                        <!-- option 1 -->
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editRoleModal">Edit Role</a></li>
                                        <!-- option 2 -->
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#removeUserModal">Remove User</a></li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Table for semesters -->
        <div class="col-md-6">
            <div class="roles">
                <div class="d-flex justify-content-between align-items-center mb-3 header">
                    <h5><b>Semesters</b></h5>
                    <button class="btn button-secondary" id="editSemesterButton" data-bs-toggle="modal" data-bs-target="#addSchoolYearModal" @click="this.schoolYearSubmit = this.addSchoolYear, this.clearSchoolYearData()">Add School Year</button>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Semester and School Year</th>
                                <th style="width: 10%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="schoolYear in this.schoolYear">
                                <td>{{ schoolYear['school_year'] }}</td>
                                <td>
                                    <a class="ellipsis-button btn btn-light" href="#" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: black">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                                        <!-- option 1 -->
                                        <li><a class="dropdown-item" @click="this.schoolYearId = schoolYear.id, SchoolYearFetchUpdate(), this.schoolYearSubmit = this.updateSchoolYear" data-bs-toggle="modal" data-bs-target="#addSchoolYearModal">Edit</a></li>
                                        <!-- option 2 -->
                                        <li><a class="dropdown-item" @click="this.schoolYearId = schoolYear.id" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Delete</a></li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
</div>

<!-- Edit Student Details Modal -->
<div class="modal fade" id="editDetailsModal" tabindex="-1" role="dialog" aria-labelledby="editDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDetailsModalLabel">Edit Student Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="editDescription">Description:</label>
                <input type="text" class="form-control" id="editDescription" value="College of Information Sciences and Computing">
                <label for="profileImage" class="mt-2">Change Profile Image: </label>
                <br>
                <input type="file" id="profileImageInput" accept="image/*">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateProfileImage()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Add School Year Modal -->
<div class="modal fade" id="addSchoolYearModal" tabindex="-1" role="dialog" aria-labelledby="addSchoolYearModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSchoolYearModalLabel" v-if="this.schoolYearSubmit == this.addSchoolYear">Add School Year</h5>
                <h5 class="modal-title" id="addSchoolYearModalLabel" v-else-if="this.schoolYearSubmit == this.updateSchoolYear">Edit School Year</h5>
            </div>
            <div class="modal-body">
            <form @submit.prevent="this.schoolYearSubmit" >
                <!-- Semester and Academic Year Input -->
                <label for="editYearSemester">Semester and Academic Year :</label>
                    <br>
                    <small> <b>ex: 1st Semester SY 2023-2024</b></small>
                    <input type="text" class="form-control" id="academicYearInput" placeholder="Enter Academic Year" v-model="addSchoolYears.school_year">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" >Save Changes</button>
                    </div>
            </form>
            </div>

        </div>
    </div>
</div>

<!-- Semester Delete confirmation-->
<div class="modal fade" id="deleteConfirmation" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this School Year</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" @click="this.deleteSchoolYear" data-bs-dismiss="modal">Delete</button>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success mt-2">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Roles Modal -->
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" onclick="saveChanges()">Save Changes</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete User Role Modal -->
<div class="modal fade" id="removeUserModal" tabindex="-1" aria-labelledby="removeUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeUserModalLabel">Delete User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure to remove this User this role?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Delete User</button>
            </div>
        </div>
    </div>
</div>

<!-- Add officers Modal -->
<div class="modal fade" id="addOfficerModal" tabindex="-1" role="dialog" aria-labelledby="addOfficerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOfficerModalLabel" v-if="this.addOfficerSubmit == this.addOfficer">Add Officer</h5>
                <h5 class="modal-title" id="addOfficerModalLabel" v-else-if="this.addOfficerSubmit == this.updateOfficer">Edit Officer</h5>
            </div>
            <div class="modal-body">
                <form @submit.prevent="this.addOfficerSubmit">
                    <div class="form-group">
                        <div v-if="this.addOfficerSubmit == this.addOfficer">
                            <label for="IDnumber"><b>ID number</b></label>
                            <input type="text" class="form-control" id="IDnumber" placeholder="Enter ID Number" v-model="this.addOfficersData.id" @input="this.fetchNameInputOrgOfficer">
                        </div>
                        <div v-else-if="this.addOfficerSubmit == this.updateOfficer">
                            <label for="IDnumber"><b>ID number</b></label>
                            <input type="text" class="form-control" id="IDnumber"  v-model="this.addOfficersData.id" @input="this.fetchNameInputOrgOfficer" disabled>
                        </div>
                        <!-- <div v-if="this.addOfficerSubmit == this.addOfficer"> -->
                            <label for="IDnumber"><b>Name</b></label>
                            <input type="text" class="form-control" id="IDnumber" disabled v-model="this.nameFilterAddOfficer">
                        <!-- </div> -->
                        
                    </div>
                    <div class="form-group mt-4">
                        <label for="positionTitle"><b>Title of Position</b></label>
                        <input type="text" class="form-control" id="positionTitle" placeholder="Enter title" v-model="this.addOfficersData.position" >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success mt-2" data-bs-dismiss="modal">Add Officer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Remove Officer Modal -->
<div class="modal fade" id="removeOfficerModal" tabindex="-1" aria-labelledby="removeOfficerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeOfficerModalLabel">Remove Officer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to remove this officer?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" @click="this.deleteOfficer()" data-bs-dismiss="modal">Remove Officer</button>
            </div>
        </div>
    </div>
</div>



<!-- Set Partners Modal -->
<div class="modal fade" id="setPartnersModal" tabindex="-1" role="dialog" aria-labelledby="setPartnersModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="setPartnersModalLabel">Choose Partners</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group Student-Councils">
                        <label for="selectCollegeCouncil"> <b> Select College Council</b></label>
                        <br>
                        <!-- Buttons for options -->
                        <button type="button" class="btn option-btn" data-option="CASSCO">CASSCO</button>
                        <button type="button" class="btn option-btn" data-option="CBMSCO">CBMSCO</button>
                        <button type="button" class="btn option-btn" data-option="COASCO">COASCO</button>
                        <button type="button" class="btn option-btn" data-option="COEDSCO">COEDSCO</button>
                        <button type="button" class="btn option-btn" data-option="COESCO">COESCO</button>
                        <button type="button" class="btn option-btn" data-option="COHESCO">COHESCO</button>
                        <button type="button" class="btn option-btn" data-option="CONSCO">CONSCO</button>
                        <button type="button" class="btn option-btn" data-option="CSCo">CSCo</button>
                        <button type="button" class="btn option-btn" data-option="CVMSCO">CVMSCO</button>
                    </div>
                    <div class="form-group Department-orgs mt-2">
                        <label for="selectDepartment"> <b>Select Department</b> </label>
                        <br>
                        <!-- Buttons for options -->
                        <button type="button" class="btn option-btn" data-option="AFFS">AFFS</button>
                        <button type="button" class="btn option-btn" data-option="BIOSOC">BIOSOC</button>
                        <button type="button" class="btn option-btn" data-option="BMAP">BMAP</button>
                        <button type="button" class="btn option-btn" data-option="CHEMSOC">CHEMSOC</button>
                        <button type="button" class="btn option-btn" data-option="CMU-BAKAS">CMU-BAKAS</button>
                        <button type="button" class="btn option-btn" data-option="CMU-ENTOMSOC">CMU-ENTOMSOC</button>
                        <button type="button" class="btn option-btn" data-option="CMU-PPS">CMU-PPS</button>
                        <button type="button" class="btn option-btn" data-option="CMUSSS">CMUSSS</button>
                        <button type="button" class="btn option-btn" data-option="ENVIROSS">ENVIROSS</button>
                        <button type="button" class="btn option-btn" data-option="HORTUSS">HORTUSS</button>
                        <button type="button" class="btn option-btn" data-option="IIEE-CSC">IIEE-CSC</button>
                        <button type="button" class="btn option-btn" data-option="JABES">JABES</button>
                        <button type="button" class="btn option-btn" data-option="JFINEX">JFINEX</button>
                        <button type="button" class="btn option-btn" data-option="JMA">JMA</button>
                        <button type="button" class="btn option-btn" data-option="JPIA">JPIA</button>
                        <button type="button" class="btn option-btn" data-option="JPSME">JPSME</button>
                        <button type="button" class="btn option-btn" data-option="LTS">LTS</button>
                        <button type="button" class="btn option-btn" data-option="MATHSOC">MATHSOC</button>
                        <button type="button" class="btn option-btn" data-option="MESA">MESA</button>
                        <button type="button" class="btn option-btn" data-option="ORGASMS">ORGASMS</button>
                        <button type="button" class="btn option-btn" data-option="PAN-AP">PAN-AP</button>
                        <button type="button" class="btn option-btn" data-option="PASOA">PASOA</button>
                        <button type="button" class="btn option-btn" data-option="PBASS">PBASS</button>
                        <button type="button" class="btn option-btn" data-option="PES">PES</button>
                        <button type="button" class="btn option-btn" data-option="PSABE-PPG">PSABE-PPG</button>
                        <button type="button" class="btn option-btn" data-option="SAEEx">SAEEx</button>
                        <button type="button" class="btn option-btn" data-option="SEES">SAEEx</button>
                        <button type="button" class="btn option-btn" data-option="SEES">SEES</button>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success mt-2">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Partner Modal -->
<div class="modal fade" id="editPartnerModal" tabindex="-1" aria-labelledby="editPartnerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPartnerModalLabel">Edit Partner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-group">
                        <label for="organizationName"><b>Name of Organization:</b></label>
                        <input type="text" class="form-control" id="organizationName">
                    </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Partner Modal -->
<div class="modal fade" id="removePartnerModal" tabindex="-1" aria-labelledby="removePartnerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removePartnerModalLabel">Delete Partner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to remove this Organization?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Delete Partner</button>
            </div>
        </div>
    </div>
</div>

</template>

<script>
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default{

    props:['org_id'],
    data(){
        return{
            addSchoolYears: {
                school_year: '',
                org_id: this.org_id,
            },
            schoolYear: [],
            schoolYearSubmit : this.addSchoolYear,
            schoolYearId: 0,
            orgOfficers: [],

            addOfficerSubmit: this.addOfficer,
            nameAddOfficer: [],
            nameFilterAddOfficer: [],
            addOfficersData:{
                id:'',
                position: '',
                org_id: this.org_id,

            },
            OfficerId: 0,
        }
    },
    mounted(){
        this.viewSchoolYear();
        this.showOfficer();
        this.showOrgUser();
    },
    methods: {
        deleteOfficer(){
            axios.delete(`/deleteOfficer/${this.OfficerId}`)
                    .then(response => {
                        this.showSucces(response.data.message);
                        this.showOfficer();
                    })
                    .catch(error => {
                        console.log(error)
                    });
        },
        updateOfficer(){
            
        },
        officerFetchUpdate(){
            axios.get(`edit_officer/${this.OfficerId}/${this.org_id}`)
                .then(response => {
                    this.addOfficersData = response.data;
                    console.log(this.addOfficersData);
                })
                .catch(error => {
                    console.log(error)
                });
        },
        addOfficer(){
            axios.post('/add_org_officer', this.addOfficersData)
                .then(response => {
                    // console.log(response.data)
                    this.showSucces(response.data.message);
                    this.showOfficer();
                })
                .catch(error => {
                    alert(error)

                });
        },
        showOrgUser(){
            axios.get(`/view_users_org/${this.org_id}`)
                .then(response => {
                    this.nameAddOfficer = response.data;
                })
                .catch(error => {
                    console.log(error)
                });
        },
        fetchNameInputOrgOfficer(){
            this.nameFilterAddOfficer = this.nameAddOfficer.filter(item => item.student_id == this.addOfficersData.id);
            if (this.nameFilterAddOfficer != null && this.nameFilterAddOfficer['0'] && this.nameFilterAddOfficer['0']['user'] && this.nameFilterAddOfficer['0']['user']['name']) {
                this.nameFilterAddOfficer = this.nameFilterAddOfficer['0']['user']['name'];
                
            }

        },
        showOfficer(){
            this.orgOfficers = [];
            axios.get(`/view_officers/${this.org_id}`)
                .then(response => {
                    response.data.forEach(element => {
                            this.orgOfficers.push({
                                id: element.id,
                                name: element.user.name,
                                position: element.position,
                            })
                        // console.log(this.orgOfficers)
                        
                    });

                })
                .catch(error => {
                    console.log(error)
                });
        },

        deleteSchoolYear(){
            axios.delete(`/deleteSchoolYear/${this.schoolYearId}`)
                    .then(response => {
                        this.showSucces(response.data.message);
                        this.viewSchoolYear();
                    })
                    .catch(error => {
                        console.log(error)
                    });

        },
        updateSchoolYear(){
            axios.put(`/update_school_year/${this.schoolYearId}`, this.addSchoolYears)
                .then(response => {
                    this.showSucces(response.data.message);
                    this.viewSchoolYear();
                })
                .catch(error => {
                    // console.error('Error updating user:', error);
                    alert('Error updating user:', error)
                });
        },
        SchoolYearFetchUpdate(){
            axios.get(`edit_school_year/${this.schoolYearId}`)
                .then(response => {
                    this.addSchoolYears = response.data
                })
                .catch(error => {
                    console.log(error)
                });
        },
        viewSchoolYear(){
            axios.get(`/view_school_year/${this.org_id}`)
                .then(response => {
                    // console.log(response.data)
                    this.schoolYear = response.data
                })
                .catch(error => {
                    alert(error)

                });
        },
        addSchoolYear(){
            axios.post('/add_school_year', this.addSchoolYears)
                .then(response => {
                    this.showSucces(response.data.message);
                    this.viewSchoolYear();
                })
                .catch(error => {
                    alert(error)

                });
        },
        showSucces(message){
            toast.success(message),{
                autoClose: 100,
            }
        },
        clearSchoolYearData(){
            this.addSchoolYears = {
                school_year:'',
                org_id: this.org_id,
                }
        },
        clearAddOfficerData(){
            this.addOfficersData={
                id:'',
                position: '',
                org_id: this.org_id,

            };
            this.nameFilterAddOfficer = [];
            
        },
    },

}

</script>

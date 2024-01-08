<template>
        <div class="col breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/login/student_organization_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Ogranization</li>
                <li class="breadcrumb-item active" aria-current="page">Organization Profile</li>
                </ol>
            </nav>
        </div>
<div id="profile-details">
<div class="row" >
    <div class="col-md-3 col-sm-12">
        <div class="profile">
            <!-- Profile content -->
            <img id="profileImage" src="https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png" alt="profile photo">
            <div class="profile-details mt-2">
                <h5><b> {{ this.orgProfile.name }}</b></h5>
                <span class="description-container">
                <small >{{ this.orgProfile.description }}</small>
            </span>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <!-- Nav tabs -->
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
                    <div class="d-flex justify-content-end">
                        <button class="btn button-secondary mr-2" id="editButton" @click="this.orgProfileDetailsFetchUpdate()" data-bs-toggle="modal" data-bs-target="#editDetailsModal">Edit Details</button>
                    </div>

                    <div class="row student-details">
                        <div class="student-org-info">
                            <!-- Student Organization Information -->
                            <h4><b>Student Organization Information</b></h4>
                            <h6 class="mb-2"><b>Description: </b> <span id="description">{{ this.orgProfile.description }}</span></h6>
                            <h6 class="mb-2"><b>Number of Members: </b> <span id="number-of-students">{{this.orgTotalMembers}}</span></h6>
                            <h6><b>Semester and Academic Year: </b> <span id="number-of-students">{{ this.school_year_org_profile }}</span></h6>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Organization Tab Content -->
            <div class="tab-pane fade" id="organization" role="tabpanel" aria-labelledby="organization-tab">
                <div class="organization-details">
                    <div class="org-officers" style="width: 50%;">
                        <!-- Organization Officers -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5><b>Organization Officers</b></h5>
                            <button class="btn button-secondary" @click="this.addOfficerSubmit = this.addOfficer, this.clearAddOfficerData()" data-bs-toggle="modal" data-bs-target="#addOfficerModal"> <i class="fas fa-plus"></i></button>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 50%; ">Name</th>
                                    <th style="width: 40%;">Position</th>
                                    <th style="width:10%;"></th>
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
                                            <!-- Edit Officer -->
                                            <li><a class="dropdown-item" @click="this.addOfficerSubmit = this.updateOfficer, this.OfficerId = officers['id'], this.officerFetchUpdate(officers.id)" data-bs-toggle="modal" data-bs-target="#addOfficerModal" >Edit Officer</a></li>
                                            <!-- Remove Officer -->
                                            <li><a class="dropdown-item" @click="this.OfficerId = officers['id']" data-bs-toggle="modal" data-bs-target="#removeOfficerModal">Remove Officer</a></li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Partner Organizations -->
                    <div class="partner-organizations" style="width: 50%;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5><b>Organizations Partners</b></h5>
                            <button class="btn button-secondary" data-bs-toggle="modal" data-bs-target="#setPartnersModal"> <i class="fas fa-plus"></i> </button>
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
                                            <!-- Edit Partner -->
                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editPartnerModal">Edit Partner</a></li>
                                            <!-- Delete Partner -->
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
</div>
<div class="containers">
        <div class="row">
            <!-- Organization Roles Table -->
            <div class="col-md-6">
                <div class="roles">
                    <div class="d-flex justify-content-between align-items-center mb-3 header">
                        <h5><b>Organization Member Roles</b></h5>
                        <button class="btn button-secondary" data-bs-toggle="modal" data-bs-target="#setRolesModal" @click="this.clearAddOfficerRole()">Set Roles</button>
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
                                <tr v-for="officerRole in this.officerRoles">
                                    <td>{{ officerRole.user.name }}</td>
                                    <td>{{ officerRole.role.name }}</td>
                                    <td>
                                        <!-- Ellipsis Button -->
                                        <a v-if="officerRole.student_id != this.user_id || officerRole.role_id != 1 " class="ellipsis-button btn btn-light" href="#" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: black">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>

                                        <!-- Dropdown Menu -->
                                        <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                                            <!-- Edit Role -->
                                            <li><a class="dropdown-item" @click=" this.officerRoleFetchUpdate(officerRole.id)" data-bs-toggle="modal" data-bs-target="#editRoleModal">Edit Role</a></li>
                                            <!-- Remove User -->
                                            <li><a class="dropdown-item" @click="this.updateOfficerRoleID = officerRole.id" data-bs-toggle="modal" data-bs-target="#removeUserModal">Remove User</a></li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table for Semesters -->
            <div class="col-md-6">
                <div class="row">
                <div class="additional-input">
                <div class="semester" style="width: 50%;">
                    <div class="d-flex justify-content-between align-items-center mb-3 header">
                        <h5><b>Semesters</b></h5>
                        <button class="btn button-secondary" id="editSemesterButton" data-bs-toggle="modal" data-bs-target="#addSchoolYearModal" @click="this.schoolYearSubmit = this.addSchoolYear, this.clearSchoolYearData()">Add School Year</button>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>School Year</th>
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
                                            <!-- Edit School Year -->
                                            <li><a class="dropdown-item" @click="this.schoolYearId = schoolYear.id, SchoolYearFetchUpdate(), this.schoolYearSubmit = this.updateSchoolYear" data-bs-toggle="modal" data-bs-target="#addSchoolYearModal">Edit</a></li>
                                            <!-- Delete School Year -->
                                            <li><a class="dropdown-item" @click="this.schoolYearId = schoolYear.id" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Delete</a></li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <div class="year-level" style="width: 50%; padding-left: 10px" >
                <div class="d-flex justify-content-between align-items-center mb-3 header">
                    <h5><b>Year Levels</b></h5>
                    <button class="btn button-secondary" id="addYearLevelButton" data-bs-toggle="modal" data-bs-target="#addYearLevelModal" > <i class="fas fa-plus"></i>  </button>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Year Level</th>
                                <th style="width: 10%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Adjust the v-for loop based on your data structure for year levels -->
                            <tr>
                                <td>1st Year</td>
                                <td>
                                    <!-- Adjust the actions based on your requirements -->
                                    <a class="ellipsis-button btn btn-light" href="#" role="button" id="ellipsisDropdownYearLevel" data-bs-toggle="dropdown" aria-expanded="false" style="color: black">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="ellipsisDropdownYearLevel">
                                        <!-- Edit Year Level -->
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addYearLevelModal">Edit</a></li>
                                        <!-- Delete Year Level -->
                                        <li><a class="dropdown-item" @click="this.yearLevelId = yearLevel.id" data-bs-toggle="modal" data-bs-target="#deleteYearLevelConfirmation">Delete</a></li>
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

    <!-- Delete Year Level Confirmation Modal -->
<div class="modal fade" id="deleteYearLevelConfirmation" tabindex="-1" aria-labelledby="deleteYearLevelConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteYearLevelConfirmationLabel">Delete Year Level</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this year level?</p>
                <!-- Display additional information about the year level if needed -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" @click="deleteYearLevelConfirm">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Student Details Modal -->
<div class="modal fade" id="editDetailsModal" tabindex="-1" role="dialog" aria-labelledby="editDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form @submit.prevent="this.updateOrgProfileDetails">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDetailsModalLabel">Edit Student Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="editDescription">Description:</label>
                    <input type="text" class="form-control" id="editDescription"  v-model="org_details_profile_input.description">
                    <!-- <label for="profileImage" class="mt-2">Change Profile Image: </label>
                    <br>
                    <input type="file" id="profileImageInput" accept="image/*"> -->
                    <div class="select-dropdown">
                        <label for="editDescription">Select Default School Year:</label>
                        <select id="sort-select" class="form-control" style="text-align: center;" v-model="org_details_profile_input.school_year">
                            <option value="0" disabled selected>Select Default School Year</option>
                            <option v-for="school_year in this.schoolYear" :value="school_year['id']" >{{ school_year['school_year'] }}</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"   data-bs-dismiss="modal">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add School Year Modal -->
<div class="modal fade" id="addSchoolYearModal" tabindex="-1" role="dialog" aria-labelledby="addSchoolYearModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSchoolYearModalLabel">Add School Year</h5>
                <h5 class="modal-title" id="addSchoolYearModalLabel">Edit School Year</h5>
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
<!-- Add Year Level Modal -->
<div class="modal fade" id="addYearLevelModal" tabindex="-1" aria-labelledby="addYearLevelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addYearLevelModalLabel">Add Year Level</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Your form fields for adding a year level -->
                <form>
                    <div class="mb-3">
                        <label for="yearLevelInput" class="form-label">Year Level</label>
                        <input type="text" class="form-control" id="yearLevelInput" placeholder="Enter Year Level">
                    </div>
                    <!-- Add more form fields as needed -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="addYearLevel">Add Year Level</button>
                </div>

                </form>
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
                <form @submit.prevent="this.addOfficerRoleSubmit">
                    <div class="form-group">
                        <label for="selectOfficer"><b>Select Officer</b></label>
                        <select class="form-control" id="selectOfficer" v-model ="addOfficerRoleData.student_id">
                            <option v-for="officer in this.orgOfficers" :value="officer.student_id" >{{ officer.name }}</option>
                        </select>
                    </div>
                    <div class="form-group mt-4">
                        <label for="selectRole"><b>Select Role</b></label>
                        <select class="form-control" id="selectRole" v-model ="addOfficerRoleData.role_id">
                            <option v-for="role in this.roles " :value="role.role_id">{{ role.name }}</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success mt-2"  data-bs-dismiss="modal">Save</button>
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
                <form id="editRoleForm" @submit.prevent="this.updateOfficerRole">
                    <div class="form-group">
                        <label for="editRole">Select Role:</label>
                        <select class="form-control" id="editRole" name="editRole"  v-model ="updatedOfficerRoleData.role_id">
                            <!-- continue on this side, display role in option and set value based on click update -->
                            <option v-for="role in this.roles " :value="role.role_id">{{ role.name }}</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success"  data-bs-dismiss="modal">Save Changes</button>
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
                <button type="button" class="btn btn-danger" @click="this.deleteOfficerRole()" data-bs-dismiss="modal">Delete User</button>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="this.addOfficerSubmit">
                    <div class="form-group">
                        <div v-if="this.addOfficerSubmit == this.addOfficer">
                            <label for="IDnumber"><b>ID number</b></label>
                            <input type="text" class="form-control" id="IDnumber" placeholder="Enter ID Number" v-model="this.addOfficersData.student_id" @change="this.fetchNameInputOrgOfficer" required>
                        </div>
                        <div v-else-if="this.addOfficerSubmit == this.updateOfficer">
                            <label for="IDnumber"><b>ID number</b></label>
                            <input type="text" class="form-control" id="IDnumber"  v-model="this.addOfficersData.student_id" disabled>
                        </div>
                        <div>
                            <label for="IDnumber"><b>Name</b></label>
                            <input type="text" class="form-control" id="IDnumber" disabled v-model="this.nameFilterAddOfficer">
                        </div>

                    </div>
                    <div class="form-group mt-4">
                        <label for="positionTitle"><b>Title of Position</b></label>
                        <input type="text" class="form-control" id="positionTitle" placeholder="Enter title" v-model="this.addOfficersData.position" required >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <div v-if="this.addOfficerSubmit == this.addOfficer">
                            <button type="submit" class="btn btn-success mt-2" data-bs-dismiss="modal">Add Officer</button>
                        </div>
                        <div v-else-if="this.addOfficerSubmit == this.updateOfficer">
                            <button type="submit" class="btn btn-success mt-2" data-bs-dismiss="modal">Update Officer</button>
                        </div>
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
                <label for="selectStudentCouncil"> <b>Select Student Council</b> </label>
                <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Select Student Council
                </button>
                <ul class="dropdown-menu" id="dropdown-org" aria-labelledby="dropdownMenuButton">
                    <li>
                        <label class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="CASSCO" id="Checkme1" />
                                <span class="form-check-label">CASSCO</span>
                            </div>
                        </label>
                    </li>
                    <li>
                        <label class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="CBMSCO" id="Checkme2" checked />
                                <span class="form-check-label">CBMSCO</span>
                            </div>
                        </label>
                    </li>
                    <li>
                        <label class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="Checkme3" />
                                <span class="form-check-label">COASCO</span>
                            </div>
                        </label>
                    </li>
                    <li>
                        <label class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="COEDSCO" id="Checkme4" checked />
                                <span class="form-check-label">COEDSCO</span>
                            </div>
                        </label>
                    </li>
                    <li>
                        <label class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="COHESCO" id="Checkme4" checked />
                                <span class="form-check-label">COHESCO</span>
                            </div>
                        </label>
                    </li>
                    <li>
                        <label class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="COHESCO" id="Checkme4" checked />
                                <span class="form-check-label">CONSCO</span>
                            </div>
                        </label>
                    </li>
                    <li>
                        <label class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="CSCo" id="Checkme4" checked />
                                <span class="form-check-label">CSCo</span>
                            </div>
                        </label>
                    </li>
                </ul>
            </div>
        <br>
    <label for="selectStudentCouncil"> <b>Select Department/Society</b> </label>

            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Select Department
                </button>
                <ul class="dropdown-menu" id="dropdown-org" aria-labelledby="dropdownMenuButton">
                    <li>
                        <label class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="PASOA" id="Checkme1" />
                                <span class="form-check-label">PASOA</span>
                            </div>
                        </label>
                    </li>
                    <li>
                        <label class="dropdown-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="JPIA" id="Checkme2" checked />
                                <span class="form-check-label">JPIA</span>
                            </div>
                        </label>
                    </li>
                </ul>

                            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success mt-2">Save</button>
                    </div>

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

    props:['org_id','user_id','school_year_session'],
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
                student_id:'',
                position: '',
                org_id: this.org_id,

            },
            OfficerId: 0,
            roles: [] ,
            addOfficerRoleData: {
                student_org_id: this.org_id,
                student_id: '',
                role_id: '',
                year_level_id: '',
            },
            addOfficerRoleSubmit: this.addOfficerRole,
            officerRoles: [],
            updatedOfficerRoleData:{
                student_org_id: this.org_id,
                student_id: '',
                role_id: '',
                year_level_id: '',
            },
            updateOfficerRoleID:0,
            orgProfile:[],
            orgTotalMembers: 0,
            org_details_profile_input: {
                description:'',
                school_year: 0

            },
            school_year_org_profile:'',
        }
    },
    mounted(){
        this.viewSchoolYear();
        this.showOrgProfile();
        this.showOfficer();
        this.showOrgUser();
        this.fetchRoles();
        this.showOfficerRole();
        this.showOrgTotalMembers();



    },
    methods: {
        updateOrgProfileDetails(){
            // console.log(this.org_details_profile_input)
            if(this.org_details_profile_input.school_year == 0){
                alert('Please input School Year')
            }
            else{
                axios.put(`/updateOrgProfileDetails/${this.orgProfile.org_id}`, this.org_details_profile_input)
                .then(response => {
                    // console.log(response.data)
                    this.showSucces(response.data.message);
                    this.showOrgProfile();

                })
                .catch(error => {
                    console.error(error);
                });
            }
        },
        orgProfileDetailsFetchUpdate(){
            this.org_details_profile_input.description = this.orgProfile.description;

            // console.log(this.orgProfile)
        },
        showOrgTotalMembers(){
            axios.get(`/view_org_total_members/${this.org_id}/${this.school_year_session}`)
                .then(response => {
                    this.orgTotalMembers = response.data;
                    // console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                });
        },
        showOrgProfile(){
            axios.get(`/view_org_profile/${this.org_id}`)
                .then(response => {
                    this.orgProfile = response.data;
                    // console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                });

                // this.school_year_org_profile =
        },

        deleteOfficerRole(){
            axios.delete(`/delete_officer_role/${this.updateOfficerRoleID}`)
                .then(response => {
                    // console.log(response.data)
                    this.showSucces(response.data.message);
                    this.showOfficerRole();
                })
                .catch(error => {
                    console.log(error)
                });
        },
        updateOfficerRole(){
            // console.log(this.updatedOfficerRoleData)
            axios.put(`/update_officer_role/${this.updateOfficerRoleID}`, this.updatedOfficerRoleData)
                .then(response => {
                    // console.log(response.data)
                    if (response.data.type == 0) {
                            this.showError(response.data.message);
                            this.showOfficerRole();
                        }
                        else{
                            this.showSucces(response.data.message);
                            this.showOfficerRole();
                        }
                })
                .catch(error => {
                    console.error(error);
                });
        },


        officerRoleFetchUpdate(id){
            this.updateOfficerRoleID = id;
            const filteredData = this.officerRoles.find(item => item.id === id );
            this.updatedOfficerRoleData = filteredData;
            // this.updatedOfficerRoleData= {
            //     student_org_id: this.org_id,
            //     student_id: filteredData.student_id,
            //     role_id: filteredData.role_id,
            //     year_level_id: filteredData.year_level_id,
            // }
            // console.log(this.updateOfficerRoleID)
        },


        showOfficerRole(){
            axios.get(`/view_officer_role/${this.org_id}`)
                .then(response => {
                    this.officerRoles = response.data;
                    // console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                });

            },
        addOfficerRole(){
            // console.log(this.orgOfficers)
            // initialize data
            let year_level = this.orgOfficers.find(item => item.student_id == this.addOfficerRoleData.student_id);
            this.addOfficerRoleData= {
                student_org_id:  this.addOfficerRoleData.student_org_id,
                student_id:  this.addOfficerRoleData.student_id,
                role_id:  this.addOfficerRoleData.role_id,
                year_level_id: year_level.year_level_id,
                school_year: this.school_year_session,
            }

            // console.log(this.addOfficerRoleData)
            // submit data
            axios.post('/add_org_officer_role', this.addOfficerRoleData)
                .then(response => {
                        // console.log(response.data)
                        if (response.data.type == 0) {
                            this.showError(response.data.message);
                            this.showOfficerRole();
                        }
                        else{
                            this.showSucces(response.data.message);
                            this.showOfficerRole();

                        }

                })
                .catch(error => {
                    alert(error)

                });

        },
        fetchRoles(){
            axios.get(`/view_roles`)
                .then(response => {
                    this.roles = response.data;
                    // console.log(this.roles)
                })
                .catch(error => {
                    console.log(error)
                });

        },
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
            // console.log( this.OfficerId);
            axios.put(`/update_officer/${this.OfficerId}`, this.addOfficersData)
                .then(response => {
                    // console.log(response.data)
                        this.showSucces(response.data.message);
                        this.showOfficer();

                })
                .catch(error => {
                    console.error(error);
                });
        },
        officerFetchUpdate(id){
            this.OfficerId = id;
            // console.log(id)
            axios.get(`edit_officer/${id}`)
                .then(response => {
                    this.addOfficersData = response.data;
                    this.nameFilterAddOfficer = response.data.user.name

                })
                .catch(error => {
                    console.log(error)
                });
        },
        addOfficer(){
            axios.post('/add_org_officer', this.addOfficersData)
                .then(response => {
                        // console.log(response.data)
                        if (response.data.type == 0) {
                            this.showError(response.data.message);
                            this.showOfficer();
                        }
                        else{
                            this.showSucces(response.data.message);
                            this.showOfficer();

                        }

                })
                .catch(error => {
                    alert(error)

                });
        },
        showOrgUser(){
            axios.get(`/view_users_org/${this.org_id}`)
                .then(response => {
                    // this.nameAddOfficer = response.data;
                    // console.log(this.nameAddOfficer)
                })
                .catch(error => {
                    console.log(error)
                });
        },
        fetchNameInputOrgOfficer(){
            axios.get(`/fetch_name_officer_input/${this.addOfficersData.student_id}`)
                .then(response => {
                    this.nameFilterAddOfficer = response.data.user.name;
                    // console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                });
        },
        showOfficer(){
            this.orgOfficers = [];
            axios.get(`/view_officers/${this.org_id}`)
                .then(response => {
                    response.data.forEach(element => {
                            this.orgOfficers.push({
                                id: element.id,
                                student_id: element.student_id,
                                name: element.user.name,
                                position: element.position,
                                year_level_id: element.year_level_id,
                            })


                    });
                    // console.log(this.orgOfficers)
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

                    this.schoolYear = response.data
                    this.schoolYear.forEach(element => {
                        if (element.id == this.school_year_session ){
                        this.school_year_org_profile = element.school_year;
                    }
                    });
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
        showError(message){
            toast.error(message),{
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
                student_id:'',
                position: '',
                org_id: this.org_id,

            };
            this.nameFilterAddOfficer = [];

        },
        clearAddOfficerRole(){
            this.addOfficerRoleData= {
                student_org_id: this.org_id,
                student_id: '',
                role_id: '',
                year_level_id: '',
            }
        },
    },

}

</script>

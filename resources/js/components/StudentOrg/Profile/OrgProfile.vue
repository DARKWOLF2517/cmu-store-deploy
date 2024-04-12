<template>
    <div>
        <div class="col breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/org_dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item">Student Ogranization</li>
                    <li class="breadcrumb-item active" aria-current="page">Organization Profile</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-8">
            <h3 class="mt-2"><i class="fas fa-list"></i> Organization Profile</h3>
        </div>
        <div v-if="loading" class="mb-4" style="padding: 10px;">
            <div class="card" aria-hidden="true" style=" height: 100%; border:none; padding: 20px;">
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="card-title placeholder-glow ">
                            <span class="placeholder col-6 bg-secondary"
                                style="height: 250px; width: 250px; border-radius: 50%;"></span>
                        </h3>
                    </div>
                    <div class="col-md-6 details-load">
                        <p class="card-text placeholder-wave mt-2 text-start ">

                            <br>
                            <span class="placeholder col-4 bg-secondary"></span>
                            <br>
                            <span class="placeholder mt-4 col-12 bg-secondary"></span>
                            <br>
                            <span class="placeholder col-8 bg-secondary mt-2"></span>
                            <br>
                            <span class="placeholder col-6 bg-secondary"></span>
                            <br>
                            <span class="placeholder col-4 bg-secondary"></span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
        <div v-else class="student-profile-page h-100">
            <div class="container-fluid" id="profile-details">
                <div class="col">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <!-- Nav tabs -->
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="true"><b>Profile</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="organization-tab" data-bs-toggle="tab" href="#organization"
                                role="tab" aria-controls="organization" aria-selected="false"><b>Organization</b></a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <!-- Profile Tab Content -->
                        <div class="tab-pane fade show active" id="profile" role="tabpanel"
                            aria-labelledby="profile-tab">
                            <div class="col">
                                <div class="row d-flex justify-content-between">
                                    <div class="col-md-4">
                                        <div class="profile">
                                            <!-- Profile content -->
                                            <input id="fileInput" type="file" name="picture" accept="image/*"
                                                @change="handleFileUpload" class="d-none">
                                            <div class="profile-content">
                                                <div class="image-container">
                                                    <div class="hover-label">
                                                        <i class="fas fa-edit"></i> Change Image
                                                    </div>
                                                    <img v-if="this.orgProfile.image" @click="openFileInput"
                                                        id="profileImage"
                                                        :src="this.tempImage ? this.tempImage : this.orgProfile.image"
                                                        alt="profile photo">
                                                    <img v-else id="profileImage" @click="openFileInput"
                                                        :src="this.tempImage ? this.tempImage : 'https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png'"
                                                        alt="user-image">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center mt-2">
                                            <button @click="this.uploadProfileImage" class="btn btn-success mt-2"
                                                id="editButton" v-if="this.tempImage">
                                                <i class="fas fa-save"></i> Save Profile Image</button>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row student-details">
                                            <!-- Add an edit button on the top right -->
                                            <div class="d-flex justify-content-end">
                                                <button class="btn button-secondary mr-2" id="editButton"
                                                    @click="this.orgProfileDetailsFetchUpdate()" data-bs-toggle="modal"
                                                    data-bs-target="#editDetailsModal">Edit Details</button>
                                            </div>
                                            <div class="profile-details mt-2 py-2">
                                                <h2 style="color: #1a815d;"><b> {{ this.orgProfile.name }}</b></h2>
                                                <h5>{{ this.orgProfile.description }}</h5>
                                            </div>
                                            <div class="student-org-info">
                                                <!-- Student Organization Information -->
                                                <!-- <h5 style="color: #14684c;"><b>Student Organization Information</b></h5> -->
                                                <!-- <h6 class="mb-2"><b>Description: </b> <span id="description">{{
        this.orgProfile.description }}</span></h6> -->
                                                <h6> <i class="fas fa-users"></i> <span><b>{{
                                                    this.orgTotalMembers }}</b> Organization members </span>
                                                </h6>
                                                <h6> <i class="fas fa-school"></i> <span>{{
                                                    this.school_year_org_profile }} </span> </h6>
                                                <h6> <i class="fas fa-users-cog"></i> <span><b> {{
                                                    this.org_officer_count
                                                            }}</b></span> Organization officers</h6>
                                                <!-- <h6 class="mb-2">Number of Members <span class="fw-bold" style="color: #14684c;"
                                                            id="number-of-students">{{
        this.orgTotalMembers }}</span></h6> -->
                                                <!-- <h6>Semester and Academic Year <span class="fw-bold"
                                                            id="number-of-students">{{
        this.school_year_org_profile }}</span></h6> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Organization Tab Content -->
                        <div class="tab-pane fade" id="organization" role="tabpanel" aria-labelledby="organization-tab">
                            <div class="row d-flex justify-content-between">
                                <div class="col-md-6"
                                    style="background-color: #ffff; border-radius: 10px; padding: 10px;">

                                    <div class="org-officers ">
                                        <!-- Organization Officers -->
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5><b>Organization Officers</b></h5>
                                            <button class="btn button-secondary"
                                                @click="this.addOfficerSubmit = this.addOfficer, this.clearAddOfficerData()"
                                                data-bs-toggle="modal" data-bs-target="#addOfficerModal"> <i
                                                    class="fas fa-plus"></i></button>
                                        </div>
                                        <div style="height: 50vh; max-height: 50vh; overflow: auto;">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 50%; ">Name</th>
                                                        <th style="width: 40%;">Position</th>
                                                        <th style="width:10%;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <div class=" h-100">
                                                        <div v-if="loading">
                                                            <span class="loader"></span>
                                                        </div>
                                                        <!-- Will show if Table is Empty -->
                                                        <div class="table-IfEmpty "
                                                            v-if="!loading && orgOfficers.length == 0">
                                                            <div>
                                                                <h6 class="text-muted"><b>
                                                                        Student Organization Officers show up here.</b>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <tr v-for="officers in this.orgOfficers">
                                                        <td>{{ officers['name'] }}</td>
                                                        <td>{{ officers['position'] }}</td>
                                                        <td>
                                                            <a class="ellipsis-button btn btn-light" href="#"
                                                                role="button" id="ellipsisDropdown"
                                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                                style="color: black">
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </a>
                                                            <ul class="dropdown-menu"
                                                                aria-labelledby="ellipsisDropdown">
                                                                <!-- Edit Officer -->
                                                                <li><a class="dropdown-item"
                                                                        @click="this.addOfficerSubmit = this.updateOfficer, this.OfficerId = officers['id'], this.officerFetchUpdate(officers.id)"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#addOfficerModal">Edit
                                                                        Officer</a></li>
                                                                <!-- Remove Officer -->
                                                                <li><a class="dropdown-item"
                                                                        @click="this.OfficerId = officers['id']"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#removeOfficerModal">Remove
                                                                        Officer</a></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col" style="background-color: #ffff; border-radius: 10px; padding: 10px;">
                                    <!-- Organizations roles-->
                                    <div class="roles">
                                        <div class="d-flex justify-content-between align-items-center mb-3 header">
                                            <h5><b>Organization Member Roles</b></h5>
                                            <button class="btn button-secondary" data-bs-toggle="modal"
                                                data-bs-target="#setRolesModal" @click="this.clearAddOfficerRole()">
                                                <i class="fas fa-plus"></i> </button>
                                        </div>
                                        <div style="height: 50vh; max-height: 50vh; overflow: auto;">
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
                                                        <div class=" h-100">
                                                            <div v-if="loading">
                                                                <span class="loader"></span>
                                                            </div>
                                                            <!-- Will show if Table is Empty -->
                                                            <div class="table-IfEmpty "
                                                                v-if="!loading && officerRoles.length == 0">
                                                                <div>
                                                                    <h6 class="text-muted"><b>
                                                                            Student Organization Officers show up
                                                                            here.</b></h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <tr v-for="officerRole in this.officerRoles">
                                                            <td>{{ officerRole.user_profile.first_name }} {{
                                                                officerRole.user_profile.last_name
                                                                }}</td>
                                                            <td>{{ officerRole.role.name }}</td>
                                                            <td>
                                                                <!-- Ellipsis Button -->
                                                                <a v-if="officerRole.student_id != this.user_id || officerRole.role_id != 1"
                                                                    class="ellipsis-button btn btn-light" href="#"
                                                                    role="button" id="ellipsisDropdown"
                                                                    data-bs-toggle="dropdown" aria-expanded="false"
                                                                    style="color: black">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </a>

                                                                <!-- Dropdown Menu -->
                                                                <ul class="dropdown-menu"
                                                                    aria-labelledby="ellipsisDropdown">
                                                                    <!-- Edit Role -->
                                                                    <li><a class="dropdown-item"
                                                                            @click=" this.officerRoleFetchUpdate(officerRole.id)"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#editRoleModal">Edit
                                                                            Role</a>
                                                                    </li>
                                                                    <!-- Remove User -->
                                                                    <li><a class="dropdown-item"
                                                                            @click="this.updateOfficerRoleID = officerRole.id"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#removeUserModal">Remove
                                                                            User</a></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col" v-if="this.orgProfile.college_id != 11">
                                    <div class="d-flex justify-content-between align-items-center mb-2 header mt-3">
                                        <h5><b>Year Levels</b></h5>
                                        <button class="btn button-secondary" id="addYearLevelButton"
                                            @click="this.clearAddYearLevel(), this.year_level_submit = this.addYearLevel"
                                            data-bs-toggle="modal" data-bs-target="#addYearLevelModal"> <i
                                                class="fas fa-plus"></i> </button>
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
                                                <div class=" h-100">
                                                    <div v-if="loading">
                                                        <span class="loader"></span>
                                                    </div>
                                                    <!-- Will show if Table is Empty -->
                                                    <div class="table-IfEmpty "
                                                        v-if="!loading && year_level_data.length == 0">
                                                        <div>
                                                            <h6 class="text-muted"><b>
                                                                    Add Year Level here.</b></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Adjust the v-for loop based on your data structure for year levels -->
                                                <tr v-for="year_level in this.year_level_data">
                                                    <td>{{ year_level.year_level }}</td>
                                                    <td>
                                                        <!-- Adjust the actions based on your requirements -->
                                                        <a class="ellipsis-button btn btn-light" href="#" role="button"
                                                            id="ellipsisDropdownYearLevel" data-bs-toggle="dropdown"
                                                            aria-expanded="false" style="color: black">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <ul class="dropdown-menu"
                                                            aria-labelledby="ellipsisDropdownYearLevel">
                                                            <!-- Edit Year Level -->
                                                            <li><a class="dropdown-item"
                                                                    @click="this.year_level_id = year_level.id, this.year_level_submit = this.updateYearLevel, this.yearLevelFetchUpdate()"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#addYearLevelModal">Edit</a>
                                                            </li>
                                                            <!-- Delete Year Level -->
                                                            <li><a class="dropdown-item"
                                                                    @click="this.year_level_id = year_level.id"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#deleteYearLevelConfirmation">Delete</a>
                                                            </li>
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
        </div>
    </div>
    <!-- Delete Year Level Confirmation Modal -->
    <div class="modal fade" id="deleteYearLevelConfirmation" tabindex="-1"
        aria-labelledby="deleteYearLevelConfirmationLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="deleteYearLevelConfirmationLabel">Delete Year Level</h5> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h4><i class="fas fa-exclamation-triangle text-warning"></i></h4>
                    <h4><b>Delete Year level</b></h4>
                    <p>Are you sure you want to remove this year level?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" @click="this.deleteYearLevel()"
                        data-bs-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Student Org Details Modal -->
    <div class="modal fade" id="editDetailsModal" tabindex="-1" role="dialog" aria-labelledby="editDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <form @submit.prevent="this.updateOrgProfileDetails"  enctype="multipart/form-data"> -->
                <form @submit.prevent="updateOrgProfileDetails">
                    <div class="modal-header">

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5 class="modal-title fw-bold text-center mb-4" id="editDetailsModalLabel">Edit Student
                            Organization
                            Details</h5>
                        <label for="editDescription">Description</label>
                        <input type="multi-line" class="form-control" id="editDescription"
                            v-model="org_details_profile_input.description" required maxlength="100"
                            :style="{ borderColor: org_details_profile_input.description.length >= 100 ? 'red' : '' }">
                        <p class="pl-2" v-if="org_details_profile_input.description.length >= 100" style="color: red;">
                            Maximum length reached</p>
                        <!-- <label for="profileImage" class="mt-2">Change Profile Image: </label> -->
                        <!-- <br>
                        <input type="file" name="picture" @change="handleFileUpload"> -->
                        <!-- <label class="mt-2" for="editDescription">Select Default School Year:</label>
                        <div class="select-dropdown" style="width: 80% !important; border: 1px solid #ccc;">

                            <select id="sort-select" class="form-control" style="text-align: center;"
                                v-model="org_details_profile_input.school_year">
                                <option value="0" disabled selected>Select Default School Year</option>
                                <option v-for="school_year in this.schoolYear" :value="school_year['id']">{{
        school_year['school_year'] }}</option>
                            </select>
                        </div> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" :disabled="isSubmitting">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Student Org Profile Picture Modal -->
    <!-- <div class="modal fade" id="changeProfileImageModal" tabindex="-1" role="dialog"
        aria-labelledby="changeProfileImageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form v-on:submit.prevent="uploadProfileImage" method="post" enctype="multipart/form-data">
                    <div class="modal-header">

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <h4><b>Upload Image</b></h4>
                            <p>Customize your profile with a profile picture.</p>
                        </div>
                        <input type="file" name="picture" accept="image/*" @change="handleFileUpload">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" value="uploadProfileImage"
                            :disabled="isSubmitting">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
    <!-- Add Year Level Modal -->
    <div class="modal fade" id="addYearLevelModal" tabindex="-1" aria-labelledby="addYearLevelModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title fw-bold text-center" id="addYearLevelModalLabel"
                        v-if="this.year_level_submit == this.addYearLevel">Add Year Level</h5>
                    <h5 class="modal-title fw-bold text-center" id="addYearLevelModalLabel"
                        v-else-if="this.year_level_submit == this.updateYearLevel">Edit Year Level</h5>
                    <!-- Your form fields for adding a year level -->
                    <form @submit.prevent="this.year_level_submit">
                        <div class="mb-3">
                            <label for="yearLevelInput" class="form-label">Year Level</label>
                            <input type="text" class="form-control" id="yearLevelInput" placeholder="Enter Year Level"
                                v-model="year_level_input.year_level" required maxlength="30"
                                :style="{ borderColor: year_level_input.year_level.length >= 30 ? 'red' : '' }">
                            <p class="pl-2" v-if="year_level_input.year_level.length >= 30" style="color: red;">
                                Maximum
                                length reached</p>
                        </div>
                        <!-- Add more form fields as needed -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" :disabled="isSubmitting">Add Year
                                Level</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Set Roles Modal -->
    <div class="modal fade" id="setRolesModal" tabindex="-1" role="dialog" aria-labelledby="setRolesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title text-center fw-bold" id="setRolesModalLabel">Set Roles</h5>
                    <form @submit.prevent="this.addOfficerRoleSubmit">
                        <div class="form-group">
                            <label for="selectOfficer"><b>Select Officer</b></label>
                            <select class="form-control" id="selectOfficer" v-model="addOfficerRoleData.student_id"
                                required>
                                <option v-for="officer in this.orgOfficers" :value="officer.student_id">{{
                                    officer.name
                                }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <label for="selectRole"><b>Select Role</b></label>
                            <select class="form-control" id="selectRole" v-model="addOfficerRoleData.role_id" required>
                                <option v-for="role in this.roles " :value="role.role_id">{{ role.name }}</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Roles Modal -->
    <div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title fw-bold text-center" id="editRoleModalLabel">Edit Role</h5>
                    <form id="editRoleForm" @submit.prevent="this.updateOfficerRole">
                        <div class="form-group">
                            <label for="editRole">Select Role:</label>
                            <select class="form-control" id="editRole" name="editRole"
                                v-model="updatedOfficerRoleData.role_id">
                                <!-- continue on this side, display role in option and set value based on click update -->
                                <option v-for="role in this.roles " :value="role.role_id">{{ role.name }}</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete User Role Modal -->
    <div class="modal fade" id="removeUserModal" tabindex="-1" aria-labelledby="removeUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="removeUserModalLabel">Delete User</h5> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h4><i class="fas fa-exclamation-triangle text-warning"></i></h4>
                    <h4><b> Remove a role to this user</b></h4>
                    <p>Are you sure you want to remove role to this user? This user will no longer have privelege.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" @click="this.deleteOfficerRole()"
                        data-bs-dismiss="modal">Delete User</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add officers Modal -->
    <div class="modal fade" id="addOfficerModal" tabindex="-1" role="dialog" aria-labelledby="addOfficerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title fw-bold text-center" id="addOfficerModalLabel"
                        v-if="this.addOfficerSubmit == this.addOfficer">Add Officer</h5>
                    <h5 class="modal-title fw-bold text-center" id="addOfficerModalLabel"
                        v-else-if="this.addOfficerSubmit == this.updateOfficer">Edit Officer</h5>
                    <form @submit.prevent="this.addOfficerSubmit">
                        <div class="form-group">
                            <div v-if="this.addOfficerSubmit == this.addOfficer">
                                <label for="IDnumber"><b>ID number</b></label>
                                <input type="text" class="form-control" id="IDnumber" placeholder="Enter ID Number"
                                    v-model="this.addOfficersData.student_id" @change="this.fetchNameInputOrgOfficer"
                                    required maxlength="15"
                                    :style="{ borderColor: addOfficersData.student_id.length >= 15 ? 'red' : '' }">
                                <p class="pl-2" v-if="addOfficersData.student_id.length >= 15" style="color: red;">
                                    Maximum
                                    length reached</p>
                            </div>
                            <div v-else-if="this.addOfficerSubmit == this.updateOfficer">
                                <label for="IDnumber"><b>ID number</b></label>
                                <input type="text" class="form-control" id="IDnumber"
                                    v-model="this.addOfficersData.student_id" disabled>
                            </div>
                            <div>
                                <label for="IDnumber"><b>Name</b></label>
                                <input type="text" class="form-control" id="IDnumber" disabled
                                    v-model="this.nameFilterAddOfficer" required>
                            </div>

                        </div>
                        <div class="form-group mt-4">
                            <label for="positionTitle"><b>Title of Position</b></label>
                            <input type="text" class="form-control" id="positionTitle" placeholder="Enter title"
                                v-model="this.addOfficersData.position" required maxlength="30"
                                :style="{ borderColor: addOfficersData.position.length >= 30 ? 'red' : '' }">
                            <p class="pl-2" v-if="addOfficersData.position.length >= 30" style="color: red;">Maximum
                                length
                                reached</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <div v-if="this.addOfficerSubmit == this.addOfficer">
                                <button type="submit" class="btn btn-success" :disabled="isSubmitting">Add
                                    Officer</button>
                            </div>
                            <div v-else-if="this.addOfficerSubmit == this.updateOfficer">
                                <button type="submit" class="btn btn-success">Update
                                    Officer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Remove Officer Modal -->
    <div class="modal fade" id="removeOfficerModal" tabindex="-1" aria-labelledby="removeOfficerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="removeOfficerModalLabel">Remove Officer</h5> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h4><i class="fas fa-exclamation-triangle text-warning"></i></h4>
                    <h4><b>You are about to remove this Officer</b></h4>
                    <p>Are you sure you want to remove this Officer?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" @click="this.deleteOfficer()"
                        data-bs-dismiss="modal">Remove Officer</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default {

    props: ['org_id', 'user_id', 'school_year_session'],
    data() {
        return {
            addSchoolYears: {
                school_year: '',
                org_id: this.org_id,
            },
            schoolYear: [],
            schoolYearSubmit: this.addSchoolYear,
            schoolYearId: 0,
            orgOfficers: [],
            addOfficerSubmit: this.addOfficer,
            nameAddOfficer: [],
            nameFilterAddOfficer: [],
            addOfficersData: {
                student_id: 0,
                position: '',
                org_id: this.org_id,
                school_year: this.school_year_session,

            },
            OfficerId: 0,
            roles: [],
            addOfficerRoleData: {
                student_org_id: this.org_id,
                student_id: '',
                role_id: '',
                year_level_id: '',
            },
            addOfficerRoleSubmit: this.addOfficerRole,
            officerRoles: [],
            updatedOfficerRoleData: {
                student_org_id: this.org_id,
                student_id: '',
                role_id: '',
                year_level_id: '',
            },
            updateOfficerRoleID: 0,
            orgProfile: [],
            orgTotalMembers: 0,
            org_details_profile_input: {
                description: '',
                // school_year: 0
                // picture: null,

            },
            picture: null,
            tempImage: null,
            school_year_org_profile: '',
            year_level_submit: this.addYearLevel,
            year_level_id: 0,
            year_level_data: [],
            year_level_input: {
                org_id: this.org_id,
                year_level: ''
            },
            isSubmitting: false,
            org_officer_count: 0,
            loading: true,

        }
    },
    mounted() {
        this.viewSchoolYear();
        this.showOrgProfile();
        this.showOfficer();
        this.showOrgUser();
        this.fetchRoles();
        this.showOfficerRole();
        this.showOrgTotalMembers();
        this.showYearLevel();
        this.orgOfficersCount();


    },
    methods: {
        openFileInput() {
            // Programmatically click on the file input element
            document.getElementById('fileInput').click();
        },
        orgOfficersCount() {
            axios.get(`/org_officer_count/${this.org_id}/${this.school_year_session}`)
                .then(response => {
                    console.log(response.data)
                    this.org_officer_count = response.data;
                })
                .catch(error => {
                    console.log(error)
                });
        },
        updateYearLevel() {
            this.isSubmitting = true;
            axios.post(`/update_year_level/${this.year_level_id}`, this.year_level_input)
                .then(response => {
                    // console.log(response.data)
                    this.showSucces(response.data.message);
                    // this.showYearLevel();

                })
                .catch(error => {
                    console.error(error);
                });
        },
        yearLevelFetchUpdate() {
            axios.get(`/year_level_fetch_update/${this.year_level_id}`)
                .then(response => {
                    this.year_level_input = response.data;
                    console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                });
        },
        deleteYearLevel() {
            axios.post(`/delete_year_level/${this.year_level_id}`)
                .then(response => {
                    // console.log(response.data)
                    this.showSucces(response.data.message);
                    // this.showYearLevel();
                })
                .catch(error => {
                    console.log(error)
                });
        },
        addYearLevel() {
            this.isSubmitting = true;
            axios.post('/add_year_level', this.year_level_input)
                .then(response => {
                    this.showSucces(response.data.message);
                    // this.showYearLevel();

                })
                .catch(error => {
                    console.log(error)
                });
        },
        showYearLevel() {
            this.loading = true;
            axios.get(`/view_year_level/${this.org_id}`)
                .then(response => {
                    this.year_level_data = response.data;
                    this.loading = false;
                })
                .catch(error => {
                    console.log(error)
                    this.loading = false;
                });
        },
        handleFileUpload(event) {
            console.log(event.target.files[0])
            this.picture = event.target.files[0];
            this.tempImage = URL.createObjectURL(this.picture);
        },
        updateOrgProfileDetails() {
            // if (!this.org_details_profile_input.picture) {
            //     alert('Please select a picture to upload');
            // }
            axios.post(`/updateOrgProfileDetails/${this.orgProfile.org_id}`, this.org_details_profile_input, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                }
            }).then(response => {
                console.log(response.data);
                // Handle success
                this.showSucces(response.data.message);

                // this.showOrgProfile();
            })
                .catch(error => {
                    console.error(error);
                });

            // }
        },
        uploadProfileImage() {

            const formData = new FormData();
            formData.append('picture', this.picture);
            axios.post(`/updateOrgProfileImage/${this.orgProfile.org_id}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                }
            }).then(response => {
                console.log(response.data);
                // Handle success
                this.showSucces(response.data.message);
                // this.showOrgProfile();
            })
                .catch(error => {
                    console.error(error);
                });
        },
        orgProfileDetailsFetchUpdate() {
            this.org_details_profile_input.description = this.orgProfile.description;

            // console.log(this.orgProfile)
        },
        showOrgTotalMembers() {
            axios.get(`/view_org_total_members/${this.org_id}/${this.school_year_session}`)
                .then(response => {
                    this.orgTotalMembers = response.data;
                    // console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                });
        },
        showOrgProfile() {
            axios.get(`/view_org_profile/${this.org_id}`)
                .then(response => {
                    this.orgProfile = response.data;
                    console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                });

            // this.school_year_org_profile =
        },

        deleteOfficerRole() {
            axios.post(`/delete_officer_role/${this.updateOfficerRoleID}`)
                .then(response => {
                    // console.log(response.data)
                    this.showSucces(response.data.message);
                    // this.showOfficerRole();
                })
                .catch(error => {
                    console.log(error)
                });
        },
        updateOfficerRole() {
            // console.log(this.updatedOfficerRoleData)
            this.isSubmitting = true;

            axios.post(`/update_officer_role/${this.updateOfficerRoleID}`, this.updatedOfficerRoleData)
                .then(response => {
                    // console.log(response.data)
                    if (response.data.type == 0) {
                        this.showError(response.data.message);

                        // this.showOfficerRole();
                    }
                    else {
                        this.showSucces(response.data.message);
                        // this.showOfficerRole();
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        },


        officerRoleFetchUpdate(id) {
            this.updateOfficerRoleID = id;
            const filteredData = this.officerRoles.find(item => item.id === id);
            this.updatedOfficerRoleData = filteredData;
            // this.updatedOfficerRoleData= {
            //     student_org_id: this.org_id,
            //     student_id: filteredData.student_id,
            //     role_id: filteredData.role_id,
            //     year_level_id: filteredData.year_level_id,
            // }
            // console.log(this.updateOfficerRoleID)
        },


        showOfficerRole() {
            this.loading = true;
            axios.get(`/view_officer_role/${this.org_id}/${this.school_year_session}`)
                .then(response => {
                    console.log(response.data)
                    this.officerRoles = response.data;
                    this.loading = false;
                })
                .catch(error => {
                    console.log(error)
                });

        },
        addOfficerRole() {
            this.isSubmitting = true;

            // find year level to add
            let year_level = this.orgOfficers.find(item => item.student_id == this.addOfficerRoleData.student_id);
            this.addOfficerRoleData = {
                student_org_id: this.addOfficerRoleData.student_org_id,
                student_id: this.addOfficerRoleData.student_id,
                role_id: this.addOfficerRoleData.role_id,
                year_level_id: year_level.year_level_id,
                school_year: this.school_year_session,
                // college_id: this.college_id,
            }

            // console.log(this.addOfficerRoleData)
            // submit data
            axios.post('/add_org_officer_role', this.addOfficerRoleData)
                .then(response => {
                    // console.log(response.data)
                    if (response.data.type == 0) {
                        this.showError(response.data.message);
                        // this.showOfficerRole();


                    }
                    else {
                        this.showSucces(response.data.message);

                        // this.showOfficerRole();

                    }

                })
                .catch(error => {
                    alert(error)

                });

        },
        fetchRoles() {
            this.loading = true;
            axios.get(`/view_roles`)
                .then(response => {
                    this.roles = response.data;
                    // console.log(this.roles)
                    this.loading = false;
                })
                .catch(error => {
                    console.log(error)
                    this.loading = false;
                });

        },
        deleteOfficer() {
            axios.post(`/deleteOfficer/${this.OfficerId}`)
                .then(response => {
                    this.showSucces(response.data.message);
                    // this.showOfficer();
                })
                .catch(error => {
                    console.log(error)
                });
        },
        updateOfficer() {
            // console.log( this.OfficerId);
            axios.post(`/update_officer/${this.OfficerId}`, this.addOfficersData)
                .then(response => {
                    // console.log(response.data)
                    this.showSucces(response.data.message);

                    // this.showOfficer();

                })
                .catch(error => {
                    console.error(error);
                });
        },
        officerFetchUpdate(id) {
            this.OfficerId = id;
            // console.log(id)
            axios.get(`edit_officer/${id}`)
                .then(response => {
                    this.addOfficersData = response.data;
                    this.nameFilterAddOfficer = response.data.user_profile.first_name + response.data.user_profile.last_name

                })
                .catch(error => {
                    console.log(error)
                });
        },
        addOfficer() {
            this.isSubmitting = true;
            axios.post('/add_org_officer', this.addOfficersData)
                .then(response => {
                    console.log(response.data)
                    if (response.data.type == 0) {
                        this.showError(response.data.message);

                    }
                    else if (response.data.type == 2) {
                        this.showError(response.data.message);

                    }
                    else {
                        this.showSucces(response.data.message);

                        // this.showOfficer();

                    }

                })
                .catch(error => {
                    alert(error)

                });
        },
        showOrgUser() {
            axios.get(`/view_users_org/${this.org_id}`)
                .then(response => {
                    // this.nameAddOfficer = response.data;
                    // console.log(this.nameAddOfficer)
                })
                .catch(error => {
                    console.log(error)
                });
        },
        fetchNameInputOrgOfficer() {
            axios.get(`/fetch_name_officer_input/${this.addOfficersData.student_id}/${this.org_id}`)
                .then(response => {
                    if (response.data != 1) {
                        this.nameFilterAddOfficer = response.data.user_profile.first_name + ' ' + response.data.user_profile.last_name;
                    }
                    else {
                        this.nameFilterAddOfficer = [];
                    }
                    console.log(response.data)

                })
                .catch(error => {
                    console.log(error)
                });
        },
        showOfficer() {
            this.orgOfficers = [];
            this.loading = true;
            axios.get(`/view_officers/${this.org_id}/${this.school_year_session}`)
                .then(response => {
                    response.data.forEach(element => {
                        this.orgOfficers.push({
                            id: element.id,
                            student_id: element.student_id,
                            name: element.user_profile.first_name + ' ' + element.user_profile.last_name,
                            position: element.position,
                            year_level_id: element.year_level_id,
                        })
                        this.loading = false;

                    });
                })
                .catch(error => {
                    console.log(error)
                    this.loading = false;
                });
        },

        deleteSchoolYear() {
            axios.post(`/deleteSchoolYear/${this.schoolYearId}`)
                .then(response => {
                    this.showSucces(response.data.message);
                    // this.viewSchoolYear();
                })
                .catch(error => {
                    console.log(error)
                });

        },
        updateSchoolYear() {
            axios.post(`/update_school_year/${this.schoolYearId}`, this.addSchoolYears)
                .then(response => {
                    this.showSucces(response.data.message);
                    // this.viewSchoolYear();
                })
                .catch(error => {
                    // console.error('Error updating user:', error);
                    alert('Error updating user:', error)
                });
        },
        SchoolYearFetchUpdate() {
            axios.get(`edit_school_year/${this.schoolYearId}`)
                .then(response => {
                    this.addSchoolYears = response.data
                })
                .catch(error => {
                    console.log(error)
                });
        },
        viewSchoolYear() {
            axios.get(`/view_school_year`)
                .then(response => {

                    this.schoolYear = response.data
                    this.schoolYear.forEach(element => {
                        if (element.id == this.school_year_session) {
                            this.school_year_org_profile = element.semester + element.school_year;
                        }
                    });
                })
                .catch(error => {
                    alert(error)

                });
        },
        addSchoolYear() {
            axios.post('/add_school_year', this.addSchoolYears)
                .then(response => {
                    this.showSucces(response.data.message);
                    // this.viewSchoolYear();
                })
                .catch(error => {
                    alert(error)

                });
        },
        showSucces(message) {
            setTimeout(() => {
                location.reload();
            }, 1000);
            toast.success(message), {
                autoClose: 100,
            }
        },
        showError(message) {
            this.isSubmitting = false;
            toast.error(message), {
                autoClose: 100,
            }
        },
        clearSchoolYearData() {
            this.addSchoolYears = {
                school_year: '',
                org_id: this.org_id,
            }
        },
        clearAddOfficerData() {
            this.addOfficersData = {
                student_id: '',
                position: '',
                org_id: this.org_id,
                school_year: this.school_year_session,

            };
            this.nameFilterAddOfficer = [];

        },
        clearAddOfficerRole() {
            this.addOfficerRoleData = {
                student_org_id: this.org_id,
                student_id: '',
                role_id: '',
                year_level_id: '',
            }
        },
        clearAddYearLevel() {
            this.year_level_input = {
                org_id: this.org_id,
                year_level: ''
            }

        },
    },

}

</script>

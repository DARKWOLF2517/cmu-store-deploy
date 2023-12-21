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
                                <button class="btn btn-light mr-2" id="editButton" data-bs-toggle="modal" data-bs-target="#editDetailsModal">Edit Details</button>
                                
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
                    <div class="tab-pane fade" id="organization" role="tabpanel" aria-labelledby="organization-tab">
                        <div class="organization-details">
                            <div class="org-officers">
                                <div class="d-flex justify-content-end mb-3">
                                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addOfficerModal">Add officers</button>
                                    <input type="file" id="fileInput" accept=".xls, .xlsx" style="display: none;">

                                    <a class="ellipsis-button btn btn-light" href="#" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: black">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                                        <!-- option 1 -->
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#viewOfficersModal">View Officers</a></li>

                                    </ul>
                                </div>
                                <h5> <b>Organization Officers</b> </h5>
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
                                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#setPartnersModal">Set Partners</button>
                                    <a class="ellipsis-button btn btn-light" href="#" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: black">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                                        <!-- option 1 -->
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#viewPartnersModal">View Partners</a></li>

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
                                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addOfficerModal">Add officers</button>
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
        <div class="d-flex">
    <!-- Committee Members Table -->
    <div class="col">
        <div class="roles">
            <div class="d-flex justify-content-between align-items-center mb-3 header">
                <h5>Roles</h5>
                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#setRolesModal">Set Roles</button>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 40%;">Name</th>
                        <th style="width: 20%;">Role</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Taylor Swift</td>
                        <td>Admin</td>
                        <td>
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#editRoleModal">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#removeUserModal">
                                <i class="fas fa-times"></i> Remove
                            </button>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Table for semesters-->
    <div class="col ms-3">
        <div class="roles">
            <div class="d-flex justify-content-between align-items-center mb-3 header">
                <h5>Semesters</h5>
                <button class="btn btn-light" id="editSemesterButton" data-bs-toggle="modal" data-bs-target="#addSchoolYearModal" @click="this.schoolYearSubmit = this.addSchoolYear, this.clearSchoolYearData()">Add School Year</button>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Semester and School Year</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="schoolYear in this.schoolYear">
                        <td>{{ schoolYear['school_year'] }}</td>
                        <td>
                            <button class="btn" @click=" this.schoolYearId = schoolYear.id ,SchoolYearFetchUpdate(), this.schoolYearSubmit = this.updateSchoolYear"  data-bs-toggle="modal" data-bs-target="#addSchoolYearModal" >
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn" @click="this.schoolYearId = schoolYear.id" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">
                                <i class="fas fa-times"></i> Remove
                            </button>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

                <label class="mt-4" for="editNumberOfStudents">Number of Members:</label>
                <input type="text" class="form-control" id="editNumberOfStudents" value="550">


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
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Ariana Grande</td>
                            <td>Vice-Chairperson Internal</td>
                            <td>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Katy Perry</td>
                            <td>Vice-Chairperson External</td>
                            <td>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Delete</button>
                            </td>
                        </tr>
                        <!-- Add more rows for other officers as needed -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- "Delete All" button -->
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteAllModal">Delete All</button>

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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success mt-2">Add Officer</button>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success mt-2">Save</button>
                    </div>
                </form>
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
        }
    },
    mounted(){
        console.log(this.org_id);
        this.viewSchoolYear()
    },
    methods: {
        deleteSchoolYear(){
            axios.delete(`/deleteSchoolYear/${this.schoolYearId}`)
                    .then(response => {
                        this.showSucces(response.data.message);
                    })
                    .catch(error => {
                        console.log(error)
            });

        },
        updateSchoolYear(){
            axios.put(`/update_school_year/${this.schoolYearId}`, this.addSchoolYears)
                .then(response => {
                    this.showSucces(response.data.message);
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
                })
                .catch(error => {
                    alert(error)

                });
        },
        showSucces(message){
            this.viewSchoolYear()
            toast.success(message),{
                autoClose: 100,
            }
        },
        clearSchoolYearData(){
            this.addSchoolYears = {
                school_year:'',
                org_id: this.org_id,
                }
        }
    },

}

</script>

<template>
    <div class="osa-container">
        <div class="row p-2">
            <div class="col-md-6">
                <div class="card p-2 border-0">
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4><i class="far fa-copy"></i> School Year</h4>
                                <button @click="this.submit = this.addSchoolYearData" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#addSchoolYearModal">
                                    <i class="fas fa-plus"></i> Add School Year
                                </button>
                            </div>
                            <div class="table-container">
                                <table class="table">
                                    <thead>
                                        <th>Type of Semester</th>
                                        <th>School Year</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="school_year in this.school_year_data">
                                            <td>{{ school_year.semester }}</td>
                                            <td>{{ school_year.school_year }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button
                                                        @click="this.id = school_year.id, this.submit = this.updateSchoolYearData, this.fetchEditSchoolYearData()"
                                                        data-bs-toggle="modal" data-bs-target="#addSchoolYearModal"
                                                        class="btn btn-warning text-light">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button @click="this.id = school_year.id" class="btn btn-danger text-light" data-bs-toggle="modal"
                                                        data-bs-target="#deleteSYConfirmation">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 p-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4><i class="far fa-copy"></i> Colleges</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCollegeModal">
                            <i class="fas fa-plus"></i> Add College
                        </button>
                    </div>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <th>College</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>CISC</td>
                                    <td>dhdhjvbdbhhf</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-warning text-light">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger text-light" data-bs-toggle="modal"
                                                data-bs-target="#deleteCollegeConfirmation">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row p-2">
            <div class="col-md-6">
                <div class="card p-2 border-0">
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4>
                                    <i class="far fa-copy"></i> Student Organizations
                                </h4>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addOrganizationModal">
                                    <i class="fas fa-plus"></i> Add Organization
                                </button>
                            </div>
                            <div class="table-container">
                                <table class="table">
                                    <thead>
                                        <th>Organization Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>CSCo</td>
                                            <td>2hehehdhjed</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button class="btn btn-warning text-light">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-danger text-light" data-bs-toggle="modal"
                                                        data-bs-target="#deleteOrganizationConfirmation">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 p-2">
                    <div class="d-flex justify-content-between">
                        <h4><i class="far fa-copy"></i> Users</h4>
                        <div class="d-flex justify-content-end gap-2 align-items-center mb-3">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                <i class="fas fa-plus"></i> Add User
                            </button>
                            <button id="uploadButton" class="btn btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#excelDataModal">
                                <i class="fas fa-file-upload"></i> Upload List
                            </button>
                            <input type="file" id="fileInput" accept=".xls,.xlsx" style="display: none" />
                        </div>
                    </div>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <th>Student ID</th>
                                <th>Full name</th>
                                <th>Year Level</th>
                                <th>Organization</th>
                                <th>College</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold">74565423</td>
                                    <td>dhdhjvbdbhhf</td>
                                    <td>2nd Year</td>
                                    <td>CSCo</td>
                                    <td>CISC</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-warning text-light">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger text-light">
                                                <i class="fas fa-trash" data-bs-toggle="modal"
                                                    data-bs-target="#deleteUserConfirmation"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-md-6">
            <div class="card p-2 border-0">
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>
                                <i class="far fa-copy"></i> Admin per Organizations
                            </h4>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assignRoleModal">
                                <i class="fas fa-plus"></i> Assign role
                            </button>
                        </div>
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <th>Student ID</th>
                                    <th>Student name</th>
                                    <th>Organization</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>64761875</td>
                                        <td>John Doe</td>
                                        <td>sjbiddwdw</td>
                                        <td>Admin</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-warning text-light">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger text-light" data-bs-toggle="modal"
                                                    data-bs-target="#deleteOrganizationConfirmation">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
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
    <!-- Upload list Modal -->
    <div class="modal fade" id="excelDataModal" tabindex="-1" aria-labelledby="excelDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="excelDataModalLabel">
                        Upload Excel File
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="uploadExcelForm">
                        <div class="mb-3">
                            <label for="fileInput" class="form-label">Select Excel File</label>
                            <input type="file" class="form-control" id="fileInput" accept=".xls,.xlsx" required />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" id="uploadExcelButton">
                        Upload
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODALS -->

    <!-- Add school year Modal -->
    <div class="modal fade" id="addSchoolYearModal" tabindex="-1" aria-labelledby="addSchoolYearModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form @submit.prevent="this.submit">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSchoolYearModalLabel"
                            v-if="this.submit == this.addSchoolYearData">
                            Add School Year
                        </h5>
                        <h5 class="modal-title" id="addSchoolYearModalLabel" v-else>
                            Edit School Year
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="semesterSelect" class="form-label">Type of Semester</label>
                            <select class="form-select" id="semesterSelect" v-model="school_year_input.semester">
                                <option value="1st Semester">1st Semester</option>
                                <option value="2nd Semester">2nd Semester</option>
                                <!-- Add more options if needed -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="schoolYearInput" class="form-label">School Year</label>
                            <input v-model="school_year_input.school_year" type="text" class="form-control"
                                id="schoolYearInput" placeholder="Enter School Year" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- Add Organization modal -->
    <div class="modal fade" id="addOrganizationModal" tabindex="-1" aria-labelledby="addOrganizationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addOrganizationModalLabel">
                        Add Organization
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="organizationName" class="form-label">Organization Name</label>
                            <input type="text" class="form-control" id="organizationName"
                                placeholder="Enter organization name" />
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3"
                                placeholder="Enter description"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Assign Role Organization modal -->
    <div class="modal fade" id="assignRoleModal" tabindex="-1" aria-labelledby="assignRoleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addOrganizationModalLabel">
                        Add Role to Officer
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="organizationName" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="studentID"
                                placeholder="Enter organization name" />
                        </div>
                        <div class="mb-3">
                            <label for="organizationName" class="form-label">Student Name</label>
                            <input type="text" class="form-control" id="studentName"
                                placeholder="Enter organization name" />
                        </div>
                        <div class="mb-3">
                            <label for="organization" class="form-label">Organization</label>
                            <select class="form-select" id="organization">
                                <option value="CSCo">CSCo</option>
                                <option value="Other">
                                    Other Organization
                                </option>
                                <!-- Add more options if needed -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="organization" class="form-label">Assign Role</label>
                            <select class="form-select" id="organization">
                                <option value="1">Admin</option>
                                <!-- Add more options if needed -->
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
    <!-- add single user modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="studentId" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="studentId" placeholder="Enter student ID" />
                        </div>
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" placeholder="Enter full name" />
                        </div>
                        <div class="mb-3">
                            <label for="yearLevel" class="form-label">Year Level</label>
                            <input type="text" class="form-control" id="yearLevel" placeholder="Enter year level" />
                        </div>
                        <div class="mb-3">
                            <label for="organization" class="form-label">Organization</label>
                            <select class="form-select" id="organization">
                                <option value="CSCo">CSCo</option>
                                <option value="Other">
                                    Other Organization
                                </option>
                                <!-- Add more options if needed -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="college" class="form-label">College</label>
                            <select class="form-select" id="college">
                                <option value="CISC">CISC</option>
                                <option value="Other College">
                                    Other College
                                </option>
                                <!-- Add more options if needed -->
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
    <!-- add college modal -->
    <div class="modal fade" id="addCollegeModal" tabindex="-1" aria-labelledby="addCollegeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCollegeModalLabel">
                        Add College
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="collegeName" class="form-label">College Name</label>
                            <input type="text" class="form-control" id="collegeName" placeholder="Enter college name" />
                        </div>
                        <div class="mb-3">
                            <label for="collegeDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="collegeDescription" rows="3"
                                placeholder="Enter description"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>

    <!-- School Year Delete Confirmation Modal -->
    <div class="modal fade" id="deleteSYConfirmation" tabindex="-1" aria-labelledby="deleteConfirmationLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h4>
                        <i class="fas fa-exclamation-triangle text-warning"></i>
                    </h4>
                    <h4><b>Delete School Year</b></h4>
                    <p>Are you sure you want to School Year?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button @click="this.deleteSchoolYear" type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- College Delete Confirmation Modal -->
    <div class="modal fade" id="deleteCollegeConfirmation" tabindex="-1" aria-labelledby="deleteConfirmationLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h4>
                        <i class="fas fa-exclamation-triangle text-warning"></i>
                    </h4>
                    <h4><b>Delete College</b></h4>
                    <p>Are you sure you want to College?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- College Delete Confirmation Modal -->
    <div class="modal fade" id="deleteOrganizationConfirmation" tabindex="-1" aria-labelledby="deleteConfirmationLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h4>
                        <i class="fas fa-exclamation-triangle text-warning"></i>
                    </h4>
                    <h4><b>Delete Organization</b></h4>
                    <p>Are you sure you want to Organization?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- User Delete Confirmation Modal -->
    <div class="modal fade" id="deleteUserConfirmation" tabindex="-1" aria-labelledby="deleteConfirmationLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h4>
                        <i class="fas fa-exclamation-triangle text-warning"></i>
                    </h4>
                    <h4><b>Delete User</b></h4>
                    <p>Are you sure you want to User?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
export default {
    data() {
        return {
            school_year_data: [],
            school_year_input: {
                semester: '',
                school_year: '',
            },
            submit: null,
            id: 0,
        }
    },
    mounted() {
        this.fetchSchoolYearData();
    },
    methods: {
        fetchSchoolYearData() {
            axios.get(`/get_school_year`)
                .then(response => {
                    console.log(response.data)
                    this.school_year_data = response.data;
                })
                .catch(error => {
                    console.log(error)
                });
        },
        addSchoolYearData() {
            axios.post('/add_school_year', this.school_year_input)
                .then(response => {
                    console.log(response.data)
                    this.showSucces(response.data.message)
                })
                .catch(error => {
                    console.log(error)
                });
        },
        fetchEditSchoolYearData() {
            console.log(this.submit)
            axios.get(`/edit_school_year/${this.id}`)
                .then(response => {
                    this.school_year_input = response.data;
                })
                .catch(error => {
                    console.log(error)
                });
        },
        updateSchoolYearData() {
            axios.put(`/update_school_year/${this.id}`, this.school_year_input)
                .then(response => {
                    console.log(response.data)
                    this.showSucces(response.data.message);

                })
                .catch(error => {
                    // console.error('Error updating user:', error);
                    alert('Error updating user:', error)
                });
        },
        deleteSchoolYear() {
            axios.delete(`/deleteSchoolYear/${this.id}`)
                .then(response => {
                    this.showSucces(response.data.message);
                    // this.viewSchoolYear();
                })
                .catch(error => {
                    console.log(error)
                });

        },
        showSucces(message) {
            // this.fetchData();
            setTimeout(() => {
                location.reload();
            }, 500);
            toast.success(message),
            {
                autoClose: 1000,
            };
        },
    },

};
</script>

<template>
    <div class="osa-container">
        <div class="row p-2">
            <div class="col-md-6">
                <div class="card p-2 border-0">
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4><i class="far fa-copy"></i> School Year</h4>
                                <button @click="
                                    this.submit = this.addSchoolYearData
                                    " class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addSchoolYearModal">
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
                                        <tr v-for="school_year in this
                                            .school_year_data">
                                            <td>{{ school_year.semester }}</td>
                                            <td>
                                                {{ school_year.school_year }}
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button @click="
                                                    (this.id =
                                                        school_year.id),
                                                        (this.submit =
                                                            this.updateSchoolYearData),
                                                        this.fetchEditSchoolYearData()
                                                        " data-bs-toggle="modal" data-bs-target="#addSchoolYearModal"
                                                        class="btn btn-warning text-light">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button @click="
                                                        this.id =
                                                        school_year.id
                                                        " class="btn btn-danger text-light" data-bs-toggle="modal"
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
                        <button @click="this.submit = this.addCollege" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addCollegeModal">
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
                                <tr v-for="college in this.college_data">
                                    <td>{{ college.college }}</td>
                                    <td>{{ college.description }}</td>
                                    <td>
                                        <div class="btn-group" role="group" v-if="college.id != 11">
                                            <button @click="
                                                (this.id = college.id),
                                                (this.submit =
                                                    this.updateCollege),
                                                this.fetchEditCollege()
                                                " data-bs-toggle="modal" data-bs-target="#addCollegeModal"
                                                class="btn btn-warning text-light">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button @click="this.id = college.id" class="btn btn-danger text-light"
                                                data-bs-toggle="modal" data-bs-target="#deleteCollegeConfirmation">
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
                                    <i class="far fa-copy"></i> Student
                                    Organizations
                                </h4>
                                <button @click="this.submit = this.addOrganization" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#addOrganizationModal">
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
                                        <tr v-for="organization in this
                                            .organization_data">
                                            <td>{{ organization.name }}</td>
                                            <td>
                                                {{ organization.description }}
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button @click="
                                                        this.submit =
                                                        this.updateOrganization, this.id = organization.org_id, this.fetchEditOrganiztion()
                                                        " data-bs-toggle="modal" data-bs-target="#addOrganizationModal"
                                                        class="btn btn-warning text-light">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button @click="this.id = organization.org_id"
                                                        class="btn btn-danger text-light" data-bs-toggle="modal"
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
                <div class="card p-2 border-0">
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4>
                                    <i class="far fa-copy"></i> Admin per
                                    Organizations
                                </h4>
                                <button @click="this.submit = this.addOrganizationAdmin" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#assignRoleModal">
                                    <i class="fas fa-plus"></i> Assign role
                                </button>
                            </div>
                            <div class="table-container">
                                <table class="table">
                                    <thead>
                                        <th>Student ID</th>
                                        <th>Student name</th>
                                        <th>Email</th>
                                        <th>Organization</th>
                                        <th>College</th>
                                        <th>Role</th>
                                        <th>School Year</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="admin in this.admins_data">
                                            <td>{{ admin.student_id }}</td>
                                            <td>{{ admin.user_profile.first_name }} {{ admin.user_profile.middle_name }}
                                                {{ admin.user_profile.last_name }}</td>
                                            <td>{{ admin.user_profile.email }}</td>
                                            <td>{{ admin.organization.name }}</td>
                                            <td>{{ admin.user_profile.college.college }}</td>
                                            <td>{{ admin.role.name }}</td>
                                            <td>{{ admin.school_year.semester }} {{ admin.school_year.school_year }}
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button
                                                        @click="this.id = admin.id, this.submit = this.updateOrganizationAdmin, this.fetchEditOrganizationAdmins()"
                                                        data-bs-toggle="modal" data-bs-target="#assignRoleModal"
                                                        class="btn btn-warning text-light">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button
                                                        @click="this.id = admin.id, this.admins_input.student_id = admin.student_id"
                                                        class="btn btn-danger text-light" data-bs-toggle="modal"
                                                        data-bs-target="#deleteAdminConfirmation">
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
    </div>
    <div class="row p-2">
        <div class="col">
            <div class="card border-0 p-2" style="height: 500px; max-height: 500px; overflow: auto;">
                <div class="d-flex justify-content-between">
                    <h4><i class="far fa-copy"></i> Users</h4>
                </div>
                <div class="d-flex ">
                    <div class="row head-container justify-content-start">
                        <div class="col-md-6">
                            <div class="input-container border rounded">
                                <i class="fa fa-search"></i>
                                <input type="text" placeholder="Search User" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="select-dropdown border" style="width: 70%;">
                                <select id="sort-select" class="form-control" style="text-align: center"
                                    v-model="school_year_input" @change="fetchData">
                                    <option value="0" disabled selected>
                                        Select Semester
                                    </option>
                                    <option v-for="school_year in this
                                        .school_year_data" :value="school_year['id']">
                                        {{ school_year["semester"] }}
                                        {{ school_year["school_year"] }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2 align-items-center mb-3">
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
    <!-- Upload list Modal -->

    <!-- <div class="modal fade" id="excelDataModal" tabindex="-1" aria-labelledby="excelDataModalLabel" aria-hidden="true">
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
                    <button type="button" class="btn btn-primary" id="uploadExcelButton" data-bs-toggle="modal" data-bs-target="#excelDataModal">
                        Upload
                    </button>
                </div>
            </div>
        </div>
    </div> -->
    <!-- MODALS -->
    <!-- Modal for displaying Excel data before Uploading -->
    <div class="modal fade" id="excelDataModal" tabindex="-1" aria-labelledby="excelDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="excelDataModalLabel">Excel Student List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form @submit.prevent="this.uploadData()">
                    <div class="modal-body"
                        style="height: 50vh !important; max-height: 50vh !important; overflow-y: auto;">
                        <div class="text-center">
                            <h5 class="fw-bold"> Enter Student ID</h5>
                            <small>Submit an Excel file containing only student ID numbers.</small>
                        </div>
                        <div class="d-flex justify-content-between">
                            <label for="select-dropdown"> Select Year Level</label>
                            <div class="select-dropdown border ">
                                <select id="sort-select" class="form-control" style="text-align: center; height: 100%;"
                                    v-model="year_level_data_input" required>
                                    <option v-for="year_level in this.year_level_data" :value="year_level.id">{{
                                        year_level.year_level }}</option>
                                </select>
                            </div>

                        </div>
                        <div class="d-flex justify-content-between">

                            <label for="select-dropdown">
                                Select College
                            </label>

                            <div class="select-dropdown border">
                                <select id="sort-select" class="form-control" style="text-align: center;"
                                    v-model="college_data_input_for_insert">
                                    <option value="0" disabled selected>Select College</option>
                                    <option v-for="college in this.college_list" :value="college.id"> {{ college.college
                                        }}
                                    </option>
                                </select>
                            </div>
                        </div>



                        <br>
                        <table class="table" id="tableModal">
                            <thead>
                                <tr>
                                    <th>Student ID Number</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Year Level or Classification</th>
                                </tr>
                            </thead>
                            <tbody id="modalStudentTableBody">
                                <!-- Excel data will be displayed here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="uploadToTableButton"
                            :disabled="isSubmitting">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                                <option value="1st Semester">
                                    1st Semester
                                </option>
                                <option value="2nd Semester">
                                    2nd Semester
                                </option>
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
            <form @submit.prevent="this.submit">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="this.submit == this.addOrganization" class="modal-title"
                            id="addOrganizationModalLabel">
                            Add Organization
                        </h5>
                        <h5 v-else class="modal-title" id="addOrganizationModalLabel">
                            Edit Organization
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="organizationName" class="form-label">Organization Name</label>
                            <input v-model="organization_input.name" type="text" class="form-control"
                                id="organizationName" placeholder="Enter organization name" />
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea v-model="organization_input.description" class="form-control" id="description"
                                rows="3" placeholder="Enter description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">College</label>
                            <select id="sort-select" class="form-control" style="text-align: center"
                                v-model="organization_input.college_id" @change="filterItems">
                                <option value="0" disabled selected>
                                    Select College
                                </option>
                                <option v-for="college in this.college_data" :value="college.id">
                                    {{ college.college }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Assign Role Organization modal -->
    <div class="modal fade" id="assignRoleModal" tabindex="-1" aria-labelledby="assignRoleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form @submit.prevent="this.submit">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="this.submit == this.addOrganizationAdmin" class="modal-title"
                            id="addOrganizationModalLabel">
                            Add Role to Officer
                        </h5>
                        <h5 v-else class="modal-title" id="addOrganizationModalLabel">
                            Update Role to Officer
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3" v-if="this.submit == this.addOrganizationAdmin">
                            <label for="studentId" class="form-label">Search Student</label>
                            <input type="text" class="form-control" id="studentId" v-model="this.admins_input.search"
                                @change="this.fetchDataDisplayName" required>
                        </div>
                        <div v-if="this.submit == this.addOrganizationAdmin" class="mb-3">
                            <label for="organizationName" class="form-label">Student ID</label>
                            <input v-model="this.admins_input.student_id" type="number" class="form-control"
                                id="studentID" placeholder="Enter Student ID" />
                        </div>
                        <div v-else class="mb-3">
                            <label for="organizationName" class="form-label">Student ID</label>
                            <input v-model="this.admins_input.student_id" type="number" class="form-control"
                                id="studentID" placeholder="Enter Student ID" disabled />
                        </div>
                        <div class="mb-3">
                            <label for="organizationName" class="form-label">First Name</label>
                            <input v-model="this.admins_input.first_name" type="text" class="form-control"
                                id="studentName" placeholder="Enter Student First Name" />
                        </div>
                        <div class="mb-3">
                            <label for="organizationName" class="form-label">Middle Name</label>
                            <input v-model="this.admins_input.middle_name" type="text" class="form-control"
                                id="studentName" placeholder="Enter Student Middle Name" />
                        </div>
                        <div class="mb-3">
                            <label for="organizationName" class="form-label">Last Name</label>
                            <input v-model="this.admins_input.last_name" type="text" class="form-control"
                                id="studentName" placeholder="Enter Student Name" />
                        </div>
                        <div class="mb-3">
                            <label for="organizationName" class="form-label">Email</label>
                            <input v-model="this.admins_input.email" type="email" class="form-control" id="studentName"
                                placeholder="Enter Student Email" />
                        </div>
                        <div class="mb-3">
                            <label for="organization" class="form-label">College</label>
                            <select v-model="this.admins_input.college" class="form-select" id="organization">
                                <option v-for="college in this.college_data" :value="college.id">{{ college.college }}
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="organization" class="form-label">Organization</label>
                            <select v-model="this.admins_input.organization" class="form-select" id="organization">
                                <option v-for="organization in this.organization_data" :value="organization.org_id">{{
                                    organization.name }}</option>
                            </select>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="organization" class="form-label">Assign Role</label>
                            <select v-model="this.admins_input.role" class="form-select" id="organization">
                                <option value="1">Admin</option>
                            </select>
                        </div> -->
                        <div class="mb-3">
                            <label for="organization" class="form-label">School Year</label>
                            <select v-model="this.admins_input.school_year" class="form-select" id="organization">
                                <option v-for="school_year in this.school_year_data" :value="school_year.id">{{
                                    school_year.semester }} {{ school_year.school_year }}</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
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
            <form @submit.prevent="this.submit">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="this.submit == this.addCollege" class="modal-title" id="addCollegeModalLabel">
                            Add College
                        </h5>
                        <h5 v-else class="modal-title" id="addCollegeModalLabel">
                            Update College
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="collegeName" class="form-label">College Name</label>
                            <input v-model="college_input.college" type="text" class="form-control" id="collegeName"
                                placeholder="Enter college name" />
                        </div>
                        <div class="mb-3">
                            <label for="collegeDescription" class="form-label">Description</label>
                            <textarea v-model="college_input.description" class="form-control" id="collegeDescription"
                                rows="3" placeholder="Enter description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </form>
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
                    <p>Are you sure you want to delete School Year?</p>
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
                    <p>Are you sure you want to delete College?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button @click="this.deleteCollege()" type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Organization Confirmation Modal -->
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
                    <p>Are you sure you want to delete Organization?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button @click="this.deleteOrganization()" type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Organization Admin Delete Confirmation Modal -->
    <div class="modal fade" id="deleteAdminConfirmation" tabindex="-1" aria-labelledby="deleteConfirmationLabel"
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
                    <h4><b>Delete Admin</b></h4>
                    <p>Are you sure you want to delete admin?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button @click="this.deleteOrganizationAdmin()" type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {
    toast
} from "vue3-toastify";
import "vue3-toastify/dist/index.css";
export default {
    data() {
        return {
            school_year_data: [],
            school_year_input: {
                semester: "",
                school_year: "",
            },
            submit: null,
            id: 0,
            college_data: [],
            college_input: {
                college: "",
                description: "",
            },
            organization_data: [],
            organization_input: {
                name: "",
                description: "",
                college_id: "",
            },
            admins_data: [],
            admins_input: {
                student_id: '',
                first_name: '',
                middle_name: '',
                last_name: '',
                email: '',
                college: '',
                organization: '',
                // role: '',
                school_year: '',
                search: '',
            },


        };
    },
    mounted() {
        this.fetchSchoolYearData();
        this.fetchCollege();
        this.fetchOrganization();
        this.fetchOrganizationAdmins();
        this.upload();
    },
    methods: {
        fetchDataDisplayName() {
            // console.log(this.student_data.student_id)
            axios.get(`/student_list/show_name/${this.admins_input.search}`)
                .then(response => {
                    console.log(response.data)
                    if (response.data.length != 0) {
                        this.admins_input.student_id = response.data.user_id;
                        this.admins_input.first_name = response.data.first_name;
                        this.admins_input.last_name = response.data.last_name;
                        this.admins_input.middle_name = response.data.middle_name;
                        this.admins_input.college = response.data.college_id;
                        this.admins_input.email = response.data.email;
                        this.admins_input.organization = response.data.user_organization.student_org_id;
                        this.admins_input.school_year = response.data.user_organization.school_year;
                    }
                    else {
                        this.admins_input.student_id = [];
                        this.admins_input.first_name = [];
                        this.admins_input.last_name = [];
                        this.admins_input.middle_name = [];
                        this.admins_input.college = [];
                        this.admins_input.email = [];
                        this.admins_input.organization = [];
                        this.admins_input.school_year = [];
                    }
                    // this.admins_input.college = response.data.user_profile.college_id;
                })
                .catch(error => {
                    console.log(error)
                });
        },
        uploadData() {

            // if (this.college_data_input == 0 || this.year_level_data_input == 0){
            //     alert('Please Choose Year Level and  College')
            // }
            // else{
            this.isSubmitting = true;
            const excelDataModal = new bootstrap.Modal(document.getElementById("excelDataModal"));
            // excelDataModal.show();
            excelDataModal.hide();

            // Get a reference to the table
            var table = document.getElementById("tableModal");
            // Initialize an empty array to store the data
            var data = [];

            // Iterate through the table rows and cells
            for (var i = 1; i < table.rows.length; i++) {
                var row = table.rows[i];
                var rowData = [];

                for (var j = 0; j < row.cells.length; j++) {
                    var cell = row.cells[j];
                    var cellContent = cell.textContent.trim(); // Trim to remove leading/trailing whitespaces

                    // Check if the cell is not empty before pushing it into the rowData array
                    if (cellContent !== "") {
                        rowData.push(cellContent);
                    }
                }

                // Check if the rowData array is not empty before pushing it into the data array
                if (rowData.length > 0) {
                    data.push(rowData);
                }
            }


            // if (data[0].length == 1) {
            this.collectedData = data;

            // Display the extracted data in the console
            this.loading = true;
            axios.post(`/upload_students/${this.school_year_input}/${this.year_level_data_input}/${this.college_data_input_for_insert}`, { data: this.collectedData })
                .then(response => {
                    console.log(response.data)
                    this.loading = false;
                    this.isSubmitting = false;
                    if (response.data.type == 0) {
                        this.showError('Error File');
                    }
                    else {
                        this.showSucces(response.data.message);
                        // this.fetchData();
                    }

                })
                .catch(error => {
                    console.log(error)
                });
            // }
            // else {
            //     this.showError('excel incorrect format');
            // }
            // }



        },
        upload() {
            document.getElementById("uploadButton").addEventListener("click", function () {
                document.getElementById("fileInput").click();
            });

            document.getElementById("fileInput").addEventListener("change", function (e) {
                const file = e.target.files[0];
                if (file) {
                    parseExcelData(file);
                }
            });

            // Function to parse the uploaded Excel file and display it in the modal
            async function parseExcelData(file) {
                const workbook = new ExcelJS.Workbook();
                const reader = new FileReader();

                reader.onload = async function (e) {
                    const buffer = e.target.result;
                    await workbook.xlsx.load(buffer);
                    const worksheet = workbook.getWorksheet(1); // Assuming data is in the first worksheet

                    // Clear the existing table content
                    const tableBody = document.getElementById("modalStudentTableBody");
                    tableBody.innerHTML = "";

                    // Populate the table with student data, excluding the first row
                    let isHeaderRow = true;
                    worksheet.eachRow({ includeEmpty: true }, function (row) {
                        if (isHeaderRow) {
                            isHeaderRow = false; // Skip the first row (header row)
                            return;
                        }

                        const newRow = document.createElement("tr");

                        row.eachCell({ includeEmpty: true }, function (cell) {
                            let cellValue = cell.text;
                            if (cell.hyperlink && cell.hyperlink.address) {
                                // If the cell contains a hyperlink, use the hyperlink's address as the cell value
                                cellValue = cell.hyperlink.address;
                            }

                            const newCell = document.createElement("td");
                            newCell.textContent = cellValue || ""; // Use an empty string if cellValue is falsy
                            newRow.appendChild(newCell);
                        });

                        tableBody.appendChild(newRow);
                    });

                    // Show the modal
                    const excelDataModal = new bootstrap.Modal(document.getElementById("excelDataModal"), { keyboard: false });
                    excelDataModal.show();


                    // var myModal = new bootstrap.Modal(document.getElementById('excelDataModal'));
                    // myModal.show();

                };

                reader.readAsArrayBuffer(file);
            }



            // // Function to handle the "Delete" button click
            // document.getElementById("modalStudentTableBody").addEventListener("click", function (e) {
            //     if (e.target && e.target.classList.contains("delete-button")) {
            //         const row = e.target.closest("tr");
            //         if (confirm("Are you sure you want to delete this student?")) {
            //             // If the user confirms the deletion, remove the row from the table
            //             row.remove();
            //         }
            //     }
            // });

            // // Function to handle the "Edit" button click
            // document.getElementById("modalStudentTableBody").addEventListener("click", function (e) {
            //     if (e.target && e.target.classList.contains("edit-button")) {
            //         const row = e.target.closest("tr");
            //         const cells = row.querySelectorAll("td");

            //         // Disable the Edit button
            //         e.target.disabled = true;

            //         // Enable editing of the student details
            //         for (let i = 0; i < cells.length - 1; i++) {
            //             const cellContent = cells[i].textContent;
            //             const input = document.createElement("input");
            //             input.value = cellContent;
            //             cells[i].textContent = "";
            //             cells[i].appendChild(input);
            //         }

            //         // Create a Save button
            //         const saveButton = document.createElement("button");
            //         saveButton.textContent = "Save";
            //         saveButton.classList.add("btn", "btn-success");
            //         row.querySelector(".edit-button").insertAdjacentElement("beforebegin", saveButton);

            //         // Handle saving changes
            //         saveButton.addEventListener("click", function () {
            //             // Update the table with the edited details
            //             for (let i = 0; i < cells.length - 1; i++) {
            //                 const input = cells[i].querySelector("input");
            //                 cells[i].textContent = input.value;
            //             }

            //             // Remove the Save button and re-enable the Edit button
            //             saveButton.remove();
            //             e.target.disabled = false;
            //         });
            //     }
            // });
        },
        showSucces(message) {
            // this.fetchData();
            setTimeout(() => {
                location.reload();
            }, 500);
            toast.success(message), {
                autoClose: 1000,
            };
        },
        showError(message) {
            toast.error(message), {
                autoClose: 1000,
            };
        },
        fetchSchoolYearData() {
            axios
                .get(`/get_school_year`)
                .then((response) => {
                    // console.log(response.data)
                    this.school_year_data = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        addSchoolYearData() {
            axios
                .post("/add_school_year", this.school_year_input)
                .then((response) => {
                    // console.log(response.data)
                    this.showSucces(response.data.message);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        fetchEditSchoolYearData() {
            console.log(this.submit);
            axios
                .get(`/edit_school_year/${this.id}`)
                .then((response) => {
                    this.school_year_input = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        updateSchoolYearData() {
            axios
                .post(`/update_school_year/${this.id}`, this.school_year_input)
                .then((response) => {
                    // console.log(response.data)
                    this.showSucces(response.data.message);
                })
                .catch((error) => {
                    // console.error('Error updating user:', error);
                    alert("Error updating user:", error);
                });
        },
        deleteSchoolYear() {
            axios
                .post(`/deleteSchoolYear/${this.id}`)
                .then((response) => {
                    this.showSucces(response.data.message);
                    // this.viewSchoolYear();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        fetchCollege() {
            axios
                .get(`/view_college`)
                .then((response) => {
                    // console.log(response.data);
                    this.college_data = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        addCollege() {
            console.log(this.college_input);
            axios
                .post("/add_college", this.college_input)
                .then((response) => {
                    // console.log(response.data)
                    this.showSucces(response.data.message);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        fetchEditCollege() {
            axios
                .get(`/edit_college/${this.id}`)
                .then((response) => {
                    console.log(response.data);
                    this.college_input = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        updateCollege() {
            axios
                .post(`/update_college/${this.id}`, this.college_input)
                .then((response) => {
                    // console.log(response.data)
                    this.showSucces(response.data.message);
                })
                .catch((error) => {
                    // console.error('Error updating user:', error);
                    alert("Error updating user:", error);
                });
        },
        deleteCollege() {
            axios
                .post(`/delete_college/${this.id}`)
                .then((response) => {
                    this.showSucces(response.data.message);
                    // this.viewSchoolYear();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        fetchOrganization() {
            axios
                .get(`/get_organization`)
                .then((response) => {
                    // console.log(response.data);
                    this.organization_data = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        addOrganization() {
            axios
                .post("/add_organization", this.organization_input)
                .then((response) => {
                    // console.log(response.data)
                    this.showSucces(response.data.message);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        fetchEditOrganiztion() {
            axios
                .get(`/edit_organization/${this.id}`)
                .then((response) => {
                    console.log(response.data);
                    this.organization_input = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        updateOrganization() {
            axios
                .post(`/update_organization/${this.id}`, this.organization_input)
                .then((response) => {
                    // console.log(response.data)
                    this.showSucces(response.data.message);
                })
                .catch((error) => {
                    // console.error('Error updating user:', error);
                    alert("Error updating user:", error);
                });
        },
        deleteOrganization() {
            axios
                .post(`/delete_organization/${this.id}`)
                .then((response) => {
                    this.showSucces(response.data.message);
                    // this.viewSchoolYear();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        fetchOrganizationAdmins() {
            axios
                .get(`/get_organization_admins`)
                .then((response) => {
                    console.log(response.data);
                    this.admins_data = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        addOrganizationAdmin() {
            axios
                .post("/add_organization_admin", this.admins_input)
                .then((response) => {
                    console.log(response.data)
                    if (response.data.status == 'error') {
                        this.showError(response.data.message);
                    }
                    else {
                        this.showSucces(response.data.message);
                    }

                })
                .catch((error) => {
                    console.log(error)
                });
        },
        fetchEditOrganizationAdmins() {
            axios
                .get(`/edit_organization_admin/${this.id}`)
                .then((response) => {
                    console.log(response.data);
                    this.admins_input.student_id = response.data.student_id;
                    this.admins_input.first_name = response.data.user_profile.first_name;
                    this.admins_input.middle_name = response.data.user_profile.middle_name;
                    this.admins_input.last_name = response.data.user_profile.last_name;
                    this.admins_input.email = response.data.user_profile.email;
                    this.admins_input.college = response.data.user_profile.college_id;
                    this.admins_input.organization = response.data.student_org_id;
                    this.admins_input.school_year = response.data.school_year.id;

                })
                .catch((error) => {
                    console.log(error);
                });
        },
        updateOrganizationAdmin() {
            axios
                .post(`/update_organization_admin/${this.id}`, this.admins_input)
                .then((response) => {
                    // console.log(response.data)
                    this.showSucces(response.data.message);
                })
                .catch((error) => {
                    // console.error('Error updating user:', error);
                    alert("Error updating user:", error);
                });
        },
        deleteOrganizationAdmin() {
            axios
                .post(`/delete_organization_admin/${this.id}/${this.admins_input.student_id}`)
                .then((response) => {
                    this.showSucces(response.data.message);
                    // this.viewSchoolYear();
                })
                .catch((error) => {
                    console.log(error);
                });
        },

    },
};

</script>

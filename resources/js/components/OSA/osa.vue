<template>
<div class="osa-container">
<div class="row p-2">
        <div class="col-md-6">
            <div class="card p-2 border-0">
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4> <i class="far fa-copy"></i> School Year</h4>
                            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addSchoolYearModal"><i class="fas fa-plus"></i> Add School Year</button>
                        </div>
                        <div class="table-container">
                        <table class="table">
                            <thead>
                                <th>Type of Semester</th>
                                <th>School Year</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1st Semester</td>
                                    <td>2023-2024</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-warning text-light"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-danger text-light"  data-bs-toggle="modal" data-bs-target="#deleteSYConfirmation"><i class="fas fa-trash"></i></button>
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

    <div class=" col-md-6 ">
                <div class="card border-0 p-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4> <i class="far fa-copy"></i> Colleges</h4>
                            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addCollegeModal"><i class="fas fa-plus"></i> Add College</button>
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
                                            <button class="btn btn-warning text-light "><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-danger text-light"  data-bs-toggle="modal" data-bs-target="#deleteCollegeConfirmation"><i class="fas fa-trash"></i></button>
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
                            <h4> <i class="far fa-copy"></i> Organizations</h4>
                            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addOrganizationModal"><i class="fas fa-plus"></i> Add Organization</button>
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
                                            <button class="btn btn-warning text-light"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-danger text-light" data-bs-toggle="modal" data-bs-target="#deleteOrganizationConfirmation"><i class="fas fa-trash"></i></button>
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
    <div class=" col-md-6 ">
                <div class="card border-0 p-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4> <i class="far fa-copy"></i> Users</h4>
                            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="fas fa-plus"></i> Add User</button>
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
                                            <button class="btn btn-warning text-light"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-danger text-light"><i class="fas fa-trash" data-bs-toggle="modal" data-bs-target="#deleteUserConfirmation"></i></button>
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

    <!-- MODALS -->
    <!-- Modal -->
<div class="modal fade" id="addSchoolYearModal" tabindex="-1" aria-labelledby="addSchoolYearModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSchoolYearModalLabel">Add School Year</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="semesterSelect" class="form-label">Type of Semester</label>
                    <select class="form-select" id="semesterSelect">
                        <option value="1st Semester">1st Semester</option>
                        <option value="2nd Semester">2nd Semester</option>
                        <!-- Add more options if needed -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="schoolYearInput" class="form-label">School Year</label>
                    <input type="text" class="form-control" id="schoolYearInput" placeholder="Enter School Year">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addOrganizationModal" tabindex="-1" aria-labelledby="addOrganizationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOrganizationModalLabel">Add Organization</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="organizationName" class="form-label">Organization Name</label>
                        <input type="text" class="form-control" id="organizationName" placeholder="Enter organization name">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="3" placeholder="Enter description"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>
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
                        <input type="text" class="form-control" id="studentId" placeholder="Enter student ID">
                    </div>
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" placeholder="Enter full name">
                    </div>
                    <div class="mb-3">
                        <label for="yearLevel" class="form-label">Year Level</label>
                        <input type="text" class="form-control" id="yearLevel" placeholder="Enter year level">
                    </div>
                    <div class="mb-3">
                        <label for="organization" class="form-label">Organization</label>
                        <select class="form-select" id="organization">
                            <option value="CSCo">CSCo</option>
                            <option value="Other"> Organization">Other Organization</option>
                            <!-- Add more options if needed -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="college" class="form-label">College</label>
                        <select class="form-select" id="college">
                            <option value="CISC">CISC</option>
                            <option value="Other College">Other College</option>
                            <!-- Add more options if needed -->
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addCollegeModal" tabindex="-1" aria-labelledby="addCollegeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCollegeModalLabel">Add College</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="collegeName" class="form-label">College Name</label>
                        <input type="text" class="form-control" id="collegeName" placeholder="Enter college name">
                    </div>
                    <div class="mb-3">
                        <label for="collegeDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="collegeDescription" rows="3" placeholder="Enter description"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>

<!-- School Year Delete Confirmation Modal -->
<div class="modal fade" id="deleteSYConfirmation" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h4><i class="fas fa-exclamation-triangle text-warning"></i></h4>
                <h4><b>Delete School Year</b></h4>
                <p>Are you sure you want to School Year?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- College Delete Confirmation Modal -->
<div class="modal fade" id="deleteCollegeConfirmation" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h4><i class="fas fa-exclamation-triangle text-warning"></i></h4>
                <h4><b>Delete College</b></h4>
                <p>Are you sure you want to College?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- College Delete Confirmation Modal -->
<div class="modal fade" id="deleteOrganizationConfirmation" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h4><i class="fas fa-exclamation-triangle text-warning"></i></h4>
                <h4><b>Delete Organization</b></h4>
                <p>Are you sure you want to Organization?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- User Delete Confirmation Modal -->
<div class="modal fade" id="deleteUserConfirmation" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h4><i class="fas fa-exclamation-triangle text-warning"></i></h4>
                <h4><b>Delete User</b></h4>
                <p>Are you sure you want to User?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default{

    mounted(){
    }
}
</script>

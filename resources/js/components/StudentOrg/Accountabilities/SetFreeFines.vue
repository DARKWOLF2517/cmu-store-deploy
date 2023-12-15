<template>
    <div class="col-md-6 col-sm-12">
        <div class="input-container">
            <i class="fa fa-search"></i>
            <input type="text" placeholder="Search" >
        </div>
    </div>

        <div class="select-dropdown" id= "semester-btn" style="margin-left: 20px; width: 270px;">
            <!-- Second dropdown -->
            <select id="sort-select" class="form-control" style="text-align: center; ">
                <option value="">Select Semester</option>
                <option value="option1">1st Semester 2023-2024</option>
                <option value="option2">2nd Semester 2022-2023</option>
                <option value="option3">1st Semester 2022-2023</option>
            </select>
        </div>


<h4> <i class="fas fa-list mt-2"></i>  Student with Free Fines</h4>

<div class="container" id="table-container">
<div class="student-buttons d-flex justify-content-end">
<div class="btn-group" role="group">
    <button  class="btn me-2" data-bs-toggle="modal" data-bs-target="#addStudentModal">
        <i class="fas fa-plus"></i> Add Student
    </button>
    <button class="btn me-2" id="add-student-list-button" onclick="printTableData()">
        <i class="fas fa-print"></i> Print
    </button>
    <button class="btn me-2" id="add-student-button" onclick="  downloadTableData()">
        <i class="fas fa-download"></i> Download
    </button>
</div>
</div>
<div class="scroll-pane">
    <table  id="accountabilities-table">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Reason</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody >
            <tr>
                <td>001</td>
                <td>John Doe</td>
                <td>Officer</td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editStudentModal" onclick="populateEditModal(this)">Edit</button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">Delete</button>
                </td>
            </tr>
            <tr>
                <td>002</td>
                <td>Jane Smith</td>
                <td>Palaro Player</td>
                <td>
                    <button type="button" class="btn btn-primary">Edit</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this record?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" onclick="deleteRow(this)">Confirm Delete</button>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" id="edit-id">

          <div class="mb-3">
            <label for="edit-name" class="form-label">Student Name</label>
            <input type="text" class="form-control" id="edit-name">
          </div>
          <div class="mb-3">
            <label for="edit-reason" class="form-label">Reason</label>
            <select class="form-select" id="edit-reason">
              <option value="officer">Officer</option>
              <option value="player">Player</option>
              <option value="student_volunteer">Student Volunteer</option>
              <option value="others">Others</option>
            </select>
          </div>

          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Add student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="studentId" class="form-label">Student ID</label>
            <input type="text" class="form-control" id="studentId">
          </div>

          <div class="mb-3">
            <label for="name" class="form-label">Student Name</label>
            <input type="text" class="form-control" id="name">
          </div>

          <div class="mb-3">
        <label for="reason" class="form-label">Reason</label>
        <select class="form-select" id="reason">
            <option value="officer">Officer</option>
            <option value="player">Player</option>
            <option value="student_volunteer">Student Volunteer</option>
            <option value="others">Others</option>
        </select>
        </div>


          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </form>
      </div>

    </div>
  </div>
</div>

</template>

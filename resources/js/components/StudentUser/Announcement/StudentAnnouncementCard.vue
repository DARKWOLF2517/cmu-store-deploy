<template>
  <div class="col-md breadcrumbs">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student_dashboard">Dashboard</a></li>
        <li class="breadcrumb-item">Student</li>
        <li class="breadcrumb-item active" aria-current="page">Announcements</li>
      </ol>
    </nav>
  </div>

  <h3> <i class="fas fa-list mt-2"></i> Announcements</h3>
  <div class="announcement-list">
    <div class="col">
      <div class="announcement-cards-list ">
        <div class="announcement-card" style=" border-left-style: solid; border-left-color: #1b9587;">
          <div class="d-flex align-items-center">
            <img src="https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png" alt="Profile Image" width="30"
              height="30" class="circular-image">
            <strong class="posted-by-title ml-2">USSCO</strong>
          </div>
          <div class="card-body">
            <h5 class="card-title mt-4"><strong>USSCO General Assembly</strong> </h5>
            <small class="date-upload text-muted"> 11/9/2023 - 10:12 AM</small>
            <p class="card-short-description mt-2">
              UCC on January 17, 2023
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Add Announcement Modal -->
  <div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-labelledby="addAnnouncementModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addAnnouncementModalLabel">Add Announcement</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label class="form-label">Title</label>
              <input type="text" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea class="form-control"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success">Add Announcement</button>
        </div>
      </div>
    </div>
  </div>
  <!-- View Modal -->
  <!-- <div class="modal fade" id="fullDetailsModal" tabindex="-1" aria-labelledby="fullDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="fullDetailsModalLabel">Full Announcement Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <h6 class="card-title mt-2 mb-2">Announcement: <strong>Lulinghayaw</strong></h6>
              <small class="date-upload">11/9/2023 - 10:12 AM</small>
              <p class="card-description">
                {{ cardDescription }}
              </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div> -->

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Announcement</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form>
            <div class="mb-3">
              <label class="form-label">Title</label>
              <input type="text" class="form-control">
            </div>

            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea class="form-control"></textarea>
            </div>

          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Delete Announcement</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this announcement?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>
</template>
    <!--
    <script>
    export default {
      data() {
        return {

        }
      },


    }

    </script> -->

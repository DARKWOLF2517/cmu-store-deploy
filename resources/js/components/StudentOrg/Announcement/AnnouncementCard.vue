<template>

<div class="breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/org_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Organization</li>
                <li class="breadcrumb-item active" aria-current="page">Announcements</li>
                </ol>
            </nav>
</div>
        <div class="mt-2">
            <div class="row head-container">
                <div class="col-md-6 col-sm-12">
                    <div class="input-container">
                        <i class="fa fa-search"></i>
                        <input type="text" placeholder="Search">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12" >
                    <!-- <button class="btn sort-btn"><i class="bi bi-sort-up"></i></button> -->
                    <div class="select-dropdown" style="width: 70%;">
                        <select id="sort-select" class="form-control" style="text-align: center;">
                            <option value="">Select Semester</option>
                            <option value="option1">1st Semester 2023-2024</option>
                            <option value="option2">2nd Semester 2022-2023</option>
                            <option value="option3">1st Semester 2022-2023</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center ">
        <h3 class="mt-2"><i class="fas fa-list"></i> Announcements</h3>
        <div class="announcement-buttons d-flex">
            <div class="btn-group" role="group">
                <button class="btn me-2" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">
                    <i class="fas fa-plus"></i> Add Announcement
                </button>
            </div>
        </div>
    </div>
</div>


        <div class="announcement-list">
            <div class="col">
                    <div class="announcement-cards-list ">
                            <div class="announcement-card" style=" border-left-style: solid; border-left-color: #1b9587;">
                                <div class="dropdown">
                                    <a class="ellipsis-button" href="#" style="color: black;" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                                        <!-- option 1 -->
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal">Edit Announcement</a></li>
                                        <!-- option 2 -->
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete Announcement</a></li>
                                    </ul>
                                </div>
                                <div class="d-flex align-items-center">
                                <!-- <img src="https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png" alt="Profile Image" width="30" height="30" class="circular-image"> -->
                                <!-- <strong class="posted-by-title ml-2">CSCo</strong> -->
                                </div>
                                <div class="card-body">
                                <h5 class="card-title mt-4"><strong>USCO General Assembly</strong> </h5>
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
    <div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-labelledby="addAnnouncementModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title fw-bold text-center" id="addAnnouncementModalLabel">Add Announcement</h5>
                <form>
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" ></textarea>
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

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5 class="modal-title fw-bold text-center" id="editModalLabel">Edit Announcement</h5>
        <form>
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" >
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" ></textarea>
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
        <!-- <h5 class="modal-title" id="deleteModalLabel">Delete Announcement</h5> -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
                                <h4><i class="fas fa-exclamation-triangle text-warning"></i></h4>
                                <h4><b>Remove Announcement</b></h4>
                                <p>Are you sure you want to remove this announcement?</p>
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

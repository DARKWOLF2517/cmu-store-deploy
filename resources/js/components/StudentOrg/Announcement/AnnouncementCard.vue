<template>
<div class="container breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/login/org_dashboard">Dashboard</a></li>
                <li class="breadcrumb-item">Student Organization</li>
                <li class="breadcrumb-item active" aria-current="page">announcements</li>
                </ol>
            </nav>
</div>
        <div class="mt-2">
            <div class="row head-container">
                <div class="col-md-6 col-sm-12">
                    <div class="input-container">
                        <i class="fa fa-search"></i>
                        <input type="text" placeholder="Search Announcement">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end;">
                    <!-- <button class="btn sort-btn"><i class="bi bi-sort-up"></i></button> -->
                    <div class="select-dropdown">
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
        <div class="announcement-buttons d-flex justify-content-end">
            <div class="btn-group" role="group">
                <button class="btn me-2" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal"><i class="fas fa-plus"></i> Add Announcement</button>
            </div>
        </div>
        <h3> <i class="fas fa-list mt-2"></i>  Announcements</h3>
        <div class="announcement-list">
            <div class="col">
                    <div class="announcement-cards-list ">
                            <div class="announcement-card">
                                <div class="dropdown">
                                    <a class="ellipsis-button" href="#" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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
                                <img src="https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png" alt="Profile Image" width="30" height="30" class="circular-image">
                                <strong class="posted-by-title ml-2">CSCo</strong>
                                </div>
                                <div class="card-body">
                                <h6 class="card-title mt-2">Announcement: <strong>Lulinghayaw</strong> </h6>
                                <small class="date-upload"> 11/9/2023 - 10:12 AM</small>
                                <br>
                                <small class="card-description">
                                {{ truncatedDescription }}
                                </small>
                            </div>
                            <button class="btn btn-success view-button" data-bs-toggle="modal" data-bs-target="#fullDetailsModal">Read more</button>
                            </div>
                    </div>
                </div>
            </div>
            <!-- Add Announcement Modal -->
<div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-labelledby="addAnnouncementModalLabel" aria-hidden="true">
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
            <input type="text" class="form-control" v-model="newAnnouncementTitle">
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" v-model="newAnnouncementDescription"></textarea>
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
  <div class="modal fade" id="fullDetailsModal" tabindex="-1" aria-labelledby="fullDetailsModalLabel" aria-hidden="true">
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
  </div>

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
            <input type="text" class="form-control" v-model="editedTitle">
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" v-model="editedDescription"></textarea>
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

<script>
export default {
  data() {
    return {
      cardDescription: `Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus, aliquam atque fugit voluptatibus dignissimos ipsum tempore ab numquam saepe veritatis possimus aut ipsam delectus assumenda sed autem omnis accusantium corrupti! `
    }
  },

  computed: {
    truncatedDescription() {
      const words = this.cardDescription.split(' ')
      return words.slice(0, 20).join(' ') + '...'
    }
  },
}

</script>

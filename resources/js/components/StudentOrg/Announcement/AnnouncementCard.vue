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
                    <input type="text" placeholder="Search Event" v-model="searchTerm" @input="filterItems">
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <!-- <button class="btn sort-btn"><i class="bi bi-sort-up"></i></button> -->
                <div class="select-dropdown" style="width: 70%;">
                    <select id="sort-select" class="form-control" style="text-align: center;" v-model="school_year_input"
                        @change="fetchData">
                        <option value="0" disabled selected>Select School Year</option>
                        <option v-for="school_year in this.school_year" :value="school_year['id']">{{
                            school_year['school_year'] }}
                        </option>
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
                    <button class="btn me-2" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal"
                        @click="this.submit = this.submitData, this.clearData()">
                        <i class="fas fa-plus"></i> Add Announcement
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="announcement-list">
        <div class="col">
            <div class="announcement-container" id="announcement-container">
                <div class="announcement-cards-list ">
                    <!-- Loading spinner -->
                    <div v-if="this.loading" class="loading-spinner-container">
                        <div class="spinner-border text-success" id="event-spinner" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <!-- Message if the container is empty -->
                    <div class="Container-IfEmpty text-center" v-if="!loading && this.announcements.length == 0">
                        <div class="Empty-Message">
                            <i class="icon 	bi bi-megaphone" id="icon-message"></i>
                            <p class="text-muted"><b>Announcements here</b>
                                <br>
                                No Announcements yet, Create Announcements Now!
                            </p>
                        </div>
                    </div>
                    <!-- Message No results found -->
                    <div class="Container-IfEmpty text-center"
                        v-if="!loading && this.filtered_announcements.length == 0 && this.announcements != 0">
                        <div class="Empty-Message">
                            <i class="icon 	fas fa-frown" id="icon-message"></i>
                            <p class="text-muted fw-bold">No result Found</p>
                        </div>
                    </div>
                    <div v-for="announcements in this.filtered_announcements">
                        <div class="announcement-card" style=" border-left-style: solid; border-left-color: #1b9587;">
                            <div class="dropdown">
                                <a class="ellipsis-button" href="#" style="color: black;" role="button"
                                    id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                                    <!-- option 1 -->
                                    <li><a class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#addAnnouncementModal"
                                            @click="this.id = announcements.id, this.submit = this.updateData, this.fetchEdit()">Edit
                                            Announcement</a></li>
                                    <!-- option 2 -->
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            @click="this.id = announcements.id">Delete Announcement</a></li>
                                </ul>
                            </div>
                            <div class="d-flex align-items-center">
                                <!-- <img src="https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png" alt="Profile Image" width="30" height="30" class="circular-image"> -->
                                <!-- <strong class="posted-by-title ml-2">CSCo</strong> -->
                            </div>
                            <div class="card-body">
                                <h5 class="card-title mt-2"><strong>{{ announcements.title }}</strong> </h5>
                                <small class="date-upload text-muted"> Posted: {{ announcements.created_at }}</small>
                                <p class="card-short-description mb-0">
                                    <b>Scheduled Date and Time:</b> {{ announcements.time }} - {{ announcements.date }}
                                </p>
                                <p class="card-short-description mt-2">
                                    {{ announcements.description }}
                                </p>
                            </div>
                        </div>
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
                <form @submit.prevent="this.submit">
                    <div class="modal-header">

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <h5 class="modal-title fw-bold text-center" id="addAnnouncementModalLabel"
                            v-if="this.submit == this.submitData">Add Announcement</h5>
                        <h5 class="modal-title fw-bold text-center" id="addAnnouncementModalLabel"
                            v-else-if="this.submit == this.updateData">Update Announcement</h5>
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" v-model="announcement_data.title" required maxlength="50"
                            :style="{ borderColor: announcement_data.title.length >= 50 ? 'red' : '' }">
                            <p class="pl-2" v-if="announcement_data.title.length >= 50" style="color: red;">Maximum length reached</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" v-model="announcement_data.description" required maxlength="255"
            :style="{ borderColor: announcement_data.description.length >= 255 ? 'red' : '' }"></textarea>
                            <p v-if="announcement_data.description.length >= 255" style="color: red;">Maximum length reached</p>
                        </div>
                        <div class="mb-3">
                            <label for="starts_at" class="form-label fw-bold">Starts at</label>
                            <div class="mb-2">
                                <label for="date">Date:</label>
                                <input type="date" name="start_date" class="form-control" id="date"
                                    v-model="this.announcement_data.date" required>
                            </div>
                            <div>
                                <label for="time">Time:</label>
                                <input type="time" name="start_attendance" class="form-control" id="time"
                                    v-model="this.announcement_data.time" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" ref="submitButton">Submit</button>
                    </div>
                </form>
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
                    <button type="button" class="btn btn-danger" @click="this.deleteData()"
                        data-bs-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { convertDate } from "../Functions/DateConverter.js";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default {
    props: ['org_id', 'school_year_session'],
    data() {
        return {
            id: 0,
            submit: this.submitData,
            school_year_input: this.school_year_session,
            school_year: [],
            announcements: [],
            filtered_announcements: [],
            searchTerm: '',
            announcement_data: {
                title: '',
                description: '',
                date: '',
                time: '',
            },
            loading: false,
            showMessage: false,
        }
    },
    mounted() {
        this.showSchoolYear();
        this.fetchData();
    },
    methods: {

        deleteData() {
            axios.delete(`/delete_announcement/${this.id}`)
                .then(response => {
                    this.fetchData();
                    this.showSucces(response.data.message);
                })
                .catch(error => {
                    console(error)

                });
        },
        updateData() {
            axios.put(`/updateAnnouncement/${this.id}`, this.announcement_data)
                .then(response => {
                    // console.log(response.data)
                    this.fetchData();
                    this.showSucces(response.data.message);
                    setTimeout(() => {
                        location.reload();
            }, 1000);
                })
                .catch(error => {
                    // console.error('Error updating user:', error);
                    alert('Error updating user:', error)
                });
        },
        fetchEdit() {
            axios.get(`/fetchEditAnnouncement/${this.id}`)
                .then(response => {
                    console.log(response.data)
                    this.announcement_data = response.data;
                })
                .catch(error => {
                    console.log(error)

                });
        },
        submitData() {
            this.$refs.submitButton.disabled = true;
            axios.post(`/addAnnouncement/${this.org_id}/${this.school_year_input}`, this.announcement_data)
                .then(response => {
                    // console.log(response.data)

                    this.fetchData();
                    this.showSucces(response.data.message);
                    setTimeout(() => {
                        location.reload();
            }, 500);
                })
                .catch(error => {
                    this.$refs.submitButton.disabled = false;

                    console.log(error)

                });
        },
        filterItems() {
            let filtered = this.announcements;
            if (this.searchTerm) {
                const searchTermLower = this.searchTerm.toLowerCase();
                filtered = filtered.filter(item =>
                    item.title.toLowerCase().includes(searchTermLower)
                );
            }
            this.filtered_announcements = filtered;
        },
        showSchoolYear() {
            axios.get(`get_school_year`)
                .then(response => {
                    // console.log(response.data)
                    this.school_year = response.data;
                })
                .catch(error => {
                    console.log(error)
                });
        },

        fetchData() {
            this.loading = true;
            this.announcements = [];
            this.filtered_announcements = [];
            axios.get(`get_announcement/${this.org_id}/${this.school_year_input}`)
                .then(response => {
                    // console.log(response.data)
                    const data = response.data;
                    data.forEach(item => {
                        item["created_at"] = convertDate(item["created_at"]);
                        item.datetime = new Date(`${item.date} ${item.time}`).getTime();
                    });

                    this.announcements = response.data.sort((a, b) => b.datetime - a.datetime);
                    this.filtered_announcements = this.announcements;
                    this.loading = false;
                })
                .catch(error => {
                    console.log(error)
                });
        },

        clearData() {
            this.announcement_data = {
                title: '',
                description: '',
                date: '',
                time: '',
            }
        },
        showSucces(message) {
            toast.success(message), {
                autoClose: 300,
            }
        },
    },


}

</script>

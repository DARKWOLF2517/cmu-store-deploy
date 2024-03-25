<template>
    <div v-if="loading" class="loading-spinner">
        <div class="load-center">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div v-else>
        <div class="announcement-list">
            <div class="Message-IfEmpty" v-if="announcement.length === 0">
                <i class="icon fas fa-bullhorn" id="icon-message"></i>
                <p class="empty-schedule">Announcements show up here</p>
            </div>
            <div class="announcement-card-list">
                <button
                    class="announcement-card btn btn-light text-start"
                    style="width: 100%"
                    v-for="announcement in announcement"
                    @click="openModal(announcement)"
                >
                    <div>
                        <p
                            class="d-flex align-items-center text-dark text-decoration-none mb-0"
                            aria-expanded="false"
                        >
                            <img
                                v-if="announcement.organization.image"
                                :src="announcement.organization.image"
                                alt="user-image"
                                width="32"
                                height="32"
                                class="rounded-circle me-2 border"
                            />
                            <img
                                v-else
                                src="https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png"
                                alt="user-image"
                                width="32"
                                height="32"
                                class="rounded-circle me-2 border"
                            />
                            <span class="profile-name"
                                ><strong>{{
                                    this.selectedAnnouncement.organization
                                }}</strong></span
                            >
                        </p>
                    </div>
                    <div >
                        <span class="Organization text-success"
                            ><b>{{ announcement.title }}</b></span
                        >
                        <div class="date-time-posted">
                            <span class="date-time-uploaded"
                                ><i
                                    ><small>{{ announcement.date }}</small></i
                                ></span
                            >
                        </div>
                    </div>
                </button>
            </div>
        </div>
        <!-- Bootstrap 5 Modal -->
        <div class="modal" id="announcementModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ selectedAnnouncement.title }}
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <!-- Content here -->

                        <p class="text-secondary text-normal"
                            >Date and time posted:
                            {{ this.selectedAnnouncement.date }}
                            {{ this.selectedAnnouncement.time }}
                        </p>
                        <p class="mt-2">
                            {{ this.selectedAnnouncement.description }}
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { convertDate } from "../Functions/DateConverter.js";
import { converTime } from "../Functions/TimeConverter.js";
export default {
    props: ["org_id", "school_year_session"],
    data() {
        return {
            announcement: [],
            loading: true,
            selectedAnnouncement: {
                title: "",
                organization: "",
                date: "",
                time: "",
                description: "",
                image: "",
            },
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios
                .get(
                    `/get_announcement/${this.org_id}/${this.school_year_session}`
                )
                .then((response) => {
                    const data = response.data;
                    data.forEach((item) => {
                        item["date"] = convertDate(item["date"]);
                    });
                    this.announcement = response.data;
                    console.log(response.data);
                    this.loading = false;
                })
                .catch((error) => {});
        },
        openModal(announcement) {
            this.selectedAnnouncement.title = announcement.title;
            this.selectedAnnouncement.organization =
                announcement.organization.name;
            this.selectedAnnouncement.date = announcement.date;

            this.selectedAnnouncement.time = converTime(announcement.time);
            this.selectedAnnouncement.description = announcement.description;
            this.selectedAnnouncement.image = announcement.organization.image;
            var modal = new bootstrap.Modal(
                document.getElementById("announcementModal")
            );
            modal.show();
        },
    },
};
</script>

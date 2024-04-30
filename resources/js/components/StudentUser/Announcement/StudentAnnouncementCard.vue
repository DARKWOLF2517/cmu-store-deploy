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
            <div class="announcement-container" id="announcement-container">
                <div class="announcement-cards-list align-items">
                    <!-- Loading spinner -->
                    <div v-if="loading" class="mb-4" style="padding: 10px;">
                        <div class="card mb-2" aria-hidden="true" style=" height: 300px; border:none; padding: 20px;">
                            <div class="">
                                <h5 class="card-title placeholder-glow ">
                                    <span class="placeholder col-6 bg-secondary"
                                        style="height: 40px; width: 40px; border-radius: 60px;"></span>
                                    <span class="placeholder col-6 bg-secondary"
                                        style="margin-left: 10px; ; width: 50px;"></span>
                                </h5>
                                <p class="card-text placeholder-glow mt-2 ">

                                    <span class="placeholder col-2 bg-secondary"></span>
                                    <br>
                                    <span class="placeholder col-4 bg-secondary"></span>
                                    <br>
                                    <span class="placeholder mt-4 col-12 bg-secondary"></span>
                                    <br>
                                    <span class="placeholder mt-4 col-12 bg-secondary"></span>
                                    <br>
                                    <span class="placeholder col-8 bg-secondary"></span>
                                    <br>
                                    <span class="placeholder col-4 bg-secondary"></span>
                                    <br>
                                    <span class="placeholder col-4 bg-secondary"></span>
                                </p>
                            </div>
                        </div>
                        <div class="card " aria-hidden="true" style=" height: 300px; border:none; padding: 20px;">
                            <div class="">
                                <h5 class="card-title placeholder-glow ">
                                    <span class="placeholder col-6 bg-secondary"
                                        style="height: 40px; width: 40px; border-radius: 60px;"></span>
                                    <span class="placeholder col-6 bg-secondary"
                                        style="margin-left: 10px; ; width: 50px;"></span>
                                </h5>
                                <p class="card-text placeholder-glow mt-2 ">

                                    <span class="placeholder col-2 bg-secondary"></span>
                                    <br>
                                    <span class="placeholder col-4 bg-secondary"></span>
                                    <br>
                                    <span class="placeholder mt-4 col-12 bg-secondary"></span>
                                    <br>
                                    <span class="placeholder mt-4 col-12 bg-secondary"></span>
                                    <br>
                                    <span class="placeholder col-8 bg-secondary"></span>
                                    <br>
                                    <span class="placeholder col-4 bg-secondary"></span>
                                    <br>
                                    <span class="placeholder col-4 bg-secondary"></span>
                                </p>
                            </div>
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
                        v-if="!loading && this.filtered_announcements.length == 0">
                        <div class="Empty-Message">
                            <i class="icon 	bi bi-megaphone" id="icon-message"></i>
                            <p class="text-muted"><b>Announcements here</b>
                                <br>
                                No Announcements yet, Create Announcements Now!
                            </p>
                        </div>
                    </div>
                    <div v-for="announcements in this.filtered_announcements">

                        <div class="announcement-card"
                            style=" border-left-style: solid; border-left-color: #1b9587; border-right-style: solid; border-right-color: #1b9587;">
                            <div>
                                <p class="d-flex align-items-center text-dark text-decoration-none "
                                    aria-expanded="false">
                                    <img v-if="announcements.organization.image" :src="announcements.organization.image"
                                        alt="user-image" width="32" height="32" class="rounded-circle me-2 border">
                                    <img v-else
                                        src="https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png"
                                        alt="user-image" width="32" height="32" class="rounded-circle me-2 border">
                                    <span class="profile-name"><strong>{{ announcements.organization.name
                                            }}</strong></span>
                                </p>
                            </div>
                            <div class="d-flex align-items-center">
                                <!-- <img src="https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png" alt="Profile Image" width="30" height="30" class="circular-image"> -->
                                <!-- <strong class="posted-by-title ml-2">CSCo</strong> -->
                            </div>
                            <div class="card-body">
                                <h5 class="card-title mt-2"><strong>{{ announcements.title }}</strong> </h5>
                                <small class="date-upload text-muted"> Posted: {{ announcements.date }} {{
                                    announcements.time }}</small>
                                <span v-if="isNewAnnouncement(announcements)"
                                    class="bg-primary rounded px-2 text-white">New</span>
                                <span v-if="announcements.important == 1"
                                    class="bg-danger rounded px-2 text-white">Important</span>
                                <p class="card-short-description mt-2">
                                    <b>Scheduled Date and Time:</b> {{ announcements.time }} - {{ announcements.date }}
                                </p>
                                <p class="card-short-description    " style="white-space: pre-wrap;">
                                    {{ announcements.description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import { convertDate } from "../../StudentOrg/Functions/DateConverter.js";
import { converTime } from "../../StudentOrg/Functions/TimeConverter.js";
export default {
    props: ['org_id', 'school_year_session'],
    data() {
        return {
            school_year_input: this.school_year_session,
            announcements: [],
            filtered_announcements: [],
            loading: true,
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        isNewAnnouncement(announcement) {
            // Define your criteria to determine if the announcement is new
            // For example, compare the announcement's created_at date with the current date
            const announcementDate = new Date(announcement.created_at);
            const currentDate = new Date();
            const timeDifference = currentDate.getTime() - announcementDate.getTime();
            const twentyFourHours = 24 * 60 * 60 * 1000; // 24 hours in milliseconds

            // Return true if the announcement was created within the last 24 hours
            return timeDifference <= twentyFourHours;
        },
        fetchData() {
            this.loading = true;
            this.announcements = [];
            this.filtered_announcements = [];
            axios.get(`get_student_annoucement/${this.school_year_input}`)
                .then(response => {
                    console.log(response.data)
                    const data = response.data;
                    data.forEach(item => {
                        console.log(item.time)
                        item["date"] = convertDate(item["date"]);
                        item["time"] = converTime(item["time"]);
                    });

                    this.announcements = response.data;
                    this.filtered_announcements = this.announcements;
                    this.loading = false;
                })
                .catch(error => {
                    console.log(error)
                    this.loading = false;
                });
        },
    },



}

</script>

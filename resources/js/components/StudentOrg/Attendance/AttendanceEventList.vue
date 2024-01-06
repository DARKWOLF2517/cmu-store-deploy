<template>
    <div class="schedule-list-container">
        <!-- Loading spinner -->
        <div v-if="loading" class="loading-spinner">
            <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <!-- Message if the container is empty -->
        <div class="Message-IfEmpty" v-if="events.length === 0 && !loading">
            <i class="icon far fa-calendar-minus" id="icon-message"></i>
            <p class="text-muted"><b>No Attendance Scheduled yet</b><br>Start an attendance.</p>
            <!-- <a class="btn btn-success" href="/student_organization_events">Go to Events</a> -->
        </div>

        <div class="schedule-card" v-for="event in this.events" :id="event.event_id">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h5><b>{{ event["name"] }}</b></h5>
                    <h6 >Start Date: {{ event["start_date"] }}</h6>
                    <h6 >Time starts at: {{ event["start_attendance"] }}</h6>
                    <h6 class="text-muted">Number of Attendance: {{ event["attendance_count"] }}</h6>
                </div>
                <div class="ml-auto">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#startAttendanceModal" @click="this.event_id = event['event_id'], this.attendanceCount()" >Start</button>
                </div>
            </div>
        </div>

        <!-- Start Attendance Modal -->
        <div class="modal fade" id="startAttendanceModal" tabindex="-1" aria-labelledby="startAttendanceModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5> Start an Attendance?</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- <p>Are you sure you want to start attendance?</p> -->
                        <div class="form-group">
                                    <label for="attendanceType">Select Attendance Type:</label>
                                    <select class="form-select" id="attendanceType" v-model="session">
                                        <option :value="1" v-if="attendance_count >= 1">Morning (Log in)</option>
                                        <option :value="2" v-if="attendance_count >= 2">Morning (Log out)</option>
                                        <option :value="3" v-if="attendance_count >= 3">Afternoon (Log in)</option>
                                        <option :value="4" v-if="attendance_count >= 4">Afternoon (Log out)</option>
                                    </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" @click="startAttendance(event_id, org_id, session)" >Start</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>


import {convertDate} from "../Functions/DateConverter.js";
    import { toast } from 'vue3-toastify';
    import 'vue3-toastify/dist/index.css';
    import {converTime} from "../Functions/TimeConverter.js";
export default {
    props: ['org_id','school_year_session'],
data() {
        return {
            loading: true,
            attendance_count:null,
            events: [],
            event_id: null,
            session: null,

        }
    },
    created() {
        this.fetchData();

        console.log("mounted")
    },
    methods: {
        attendanceCount(){
            axios.get(`/attendance/count/${this.event_id}/${this.org_id}`)
                .then(response => {
                    this.attendance_count = response.data;
                })
                .catch(error => {
                    console.log(error)
                });

    },
    fetchData(){
        console.log(this.school_year_session)
        axios.get(`/events/show/${this.org_id}/${this.school_year_session}`)
            .then(response => {
                this.loading = false;
                const data = response.data;
                data.forEach(item => {
                    item["start_attendance"] = converTime(item["start_attendance"]);
                    item["end_attendance"] = converTime(item["end_attendance"]);
                    item["start_date"] = convertDate(item["start_date"]);
                });
                console.log(response.data);
                this.events = response.data

            })
            .catch(error => {
            // this.loading = false;
                console.log(error)
            });
                },

        startAttendance(event_id, org_id, session){

            if (event_id === null || org_id === null || session === null) {
                // console.error('Error: One or more parameters are null');
                if(session == null){
                    alert('Please Select Attendance Type.');
                }
                // You can handle the error here, such as displaying a message to the user
                return; // Exit the method early if there's an error
            }
            else{
                 //query for qr scanner with event_id
                window.location.href = `student_qrscanner/${event_id}/${org_id}/${session}`;
            }

        },

    }
}
</script>

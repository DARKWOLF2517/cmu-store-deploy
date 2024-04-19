<template>
    <div class="schedule-list-container" id="schedule-list">
        <!-- Loading spinner -->
        <div v-if="loading" style="padding: 10px;">
            <div class="card mb-2" aria-hidden="true" style=" height: 150px; border:none; ">
                <div class="card-body ">
                    <small class="card-text placeholder-glow ">
                        <span class="placeholder col-6 mt-0 bg-secondary"></span>
                        <br>
                        <span class="placeholder col-4 mt-0 bg-secondary placeholder-sm"></span>
                        <br>
                        <span class="placeholder col-4 mt-0 bg-secondary placeholder-sm"></span>
                    </small>
                    <div class="d-flex justify-content-end">
                        <button type="button" tabindex="-1" class="btn btn-secondary mt-2 disabled placeholder col-6 "
                            style="height: 35px; width: 110px;"></button>
                    </div>
                </div>
            </div>
            <div class="card mb-2" aria-hidden="true" style=" height: 150px; border:none; ">
                <div class="card-body ">
                    <small class="card-text placeholder-glow ">
                        <span class="placeholder col-6 mt-0 bg-secondary"></span>
                        <br>
                        <span class="placeholder col-4 mt-0 bg-secondary placeholder-sm"></span>
                        <br>
                        <span class="placeholder col-4 mt-0 bg-secondary placeholder-sm"></span>
                    </small>
                    <div class="d-flex justify-content-end">
                        <button type="button" tabindex="-1" class="btn btn-secondary mt-2 disabled placeholder col-6 "
                            style="height: 35px; width: 110px;"></button>
                    </div>
                </div>
            </div>
            <div class="card mb-2" aria-hidden="true" style=" height: 150px; border:none; ">
                <div class="card-body ">
                    <small class="card-text placeholder-glow ">
                        <span class="placeholder col-6 mt-0 bg-secondary"></span>
                        <br>
                        <span class="placeholder col-4 mt-0 bg-secondary placeholder-sm"></span>
                        <br>
                        <span class="placeholder col-4 mt-0 bg-secondary placeholder-sm"></span>
                    </small>
                    <div class="d-flex justify-content-end">
                        <button type="button" tabindex="-1" class="btn btn-secondary mt-2 disabled placeholder col-6 "
                            style="height: 35px; width: 110px;"></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Message if the container is empty -->
        <div class="Message-IfEmpty" v-if="events.length === 0 && !loading">
            <i class="icon far fa-calendar-minus" id="icon-message"></i>
            <p class="text-muted"><b>No Attendance Scheduled yet</b><br>Start an attendance.</p>
            <!-- <a class="btn btn-success" href="/student_organization_events">Go to Events</a> -->
        </div>

        <div class="schedule-card " v-for="event in this.events" :id="event.event_id" :class="[
            'border-top',
            'border-5',
            {
                'border-secondary': event.event_status == 0,
                'border-warning': event.event_status == 1,
                'border-success': event.event_status == 2,
            },
            'border-bottom-0',
        ]" :title="event.event_status == 0
            ? 'Event not started yet'
            : event.event_status == 1
                ? 'Event Ongoing'
                : event.event_status == 2
                    ? 'Event Completed'
                    : ''
            ">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="mb-2"><b>{{ event["name"] }}</b></h5>
                    <p class="mt-2">Start Date: {{ event["start_date"] }}</p>
                    <p>Time starts at: {{ event["start_attendance"] }}</p>
                    <p class="text-muted">Number of Attendance: {{ event["attendance_count"] }}</p>
                    <p class="text-muted fw-bold">Number of Attendance Checker: {{ event['event_attendance_checker'] }}
                    </p>
                </div>
                <div class="mt-auto" v-if="event.attendance_status == 1">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#startAttendanceConfirmation"
                        @click="this.event_id = event['event_id'], this.session = event.attendance_session_started, this.attendance_log_started = event.attendance_log_started, this.attendanceCount()">Start</button>
                </div>
                <div class="mt-auto" v-else-if="event.attendance_status == 0 || event.attendance_status == 2">
                    <button class="btn btn-secondary text-dark" disabled>Unavailable</button>
                </div>
            </div>
        </div>
        <!-- Start Attendance confirmation -->
        <div class="modal fade " id="startAttendanceConfirmation" tabindex="-1"
            aria-labelledby="startAttendanceConfirmationLabel" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <h4><i class="fas fa-question-circle text-warning"></i>
                        </h4>
                        <p>Are you sure you want to Start Attendance to this Event?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                        <button type="button" class="btn btn-success"
                            @click="startAttendance(this.event_id, this.org_id, this.session, this.attendance_log_started)"
                            data-bs-dismiss="modal">
                            <div>Start Attendance</div>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start Attendance Modal -->
        <!-- <div class="modal fade" id="startAttendanceModal" tabindex="-1" aria-labelledby="startAttendanceModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">


                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                        <h4> <i class="fas fa-question-circle text-warning"></i> </h4>
                        <h5 class="fw-bold text-center"> Start an Attendance?</h5>
                    </div>
                        <label class="mt-2">Select Attendance Type:</label>
                        <div class="select-dropdown" style="width: 100% !important; border: 1px solid #ccc;">

                        <select id="sort-select" class="form-control" style="text-align: center;"  v-model="session">
                            <option value="0" disabled selected>Select Attendace Type</option>
                            <option :value="1" v-if="attendance_count >= 1">Morning (Log in)</option>
                                        <option :value="2" v-if="attendance_count >= 2">Morning (Log out)</option>
                                        <option :value="3" v-if="attendance_count >= 3">Afternoon (Log in)</option>
                                        <option :value="4" v-if="attendance_count >= 4">Afternoon (Log out)</option>
                        </select>
                        </div> -->
        <!-- <div class="form-group">
                                    <label for="attendanceType">Select Attendance Type:</label>
                                    <select class="form-select " id="attendanceType" v-model="session">
                                        <option :value="1" v-if="attendance_count >= 1">Morning (Log in)</option>
                                        <option :value="2" v-if="attendance_count >= 2">Morning (Log out)</option>
                                        <option :value="3" v-if="attendance_count >= 3">Afternoon (Log in)</option>
                                        <option :value="4" v-if="attendance_count >= 4">Afternoon (Log out)</option>
                                    </select>
                        </div> -->
        <!-- </div> -->
        <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" @click="startAttendance(event_id, org_id, session)" >Start</button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    </div>
</template>


<script>


import { convertDate } from "../Functions/DateConverter.js";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { converTime } from "../Functions/TimeConverter.js";
export default {
    props: ['org_id', 'school_year_session'],
    data() {
        return {
            loading: true,
            attendance_count: null,
            events: [],
            event_id: null,
            session: null,
            attendance_log_started: null,

        }
    },
    created() {
        this.fetchData();

        console.log("mounted")
    },
    methods: {
        // attendanceCheckerCount(event_id) {
        //     axios.get(`/attendance_checker_count/${event_id}`)
        //         .then(response => {
        //             console.log(response.data)
        //             return response.data;
        //         })
        //         .catch(error => {
        //             console.log(error)
        //         });
        // },
        attendanceCount() {
            axios.get(`/attendance/count/${this.event_id}/${this.org_id}`)
                .then(response => {
                    this.attendance_count = response.data;
                })
                .catch(error => {
                    console.log(error)
                });

        },
        fetchData() {
            console.log(this.school_year_session)
            axios.get(`/events/show/${this.org_id}/${this.school_year_session}`)
                .then(response => {
                    this.loading = false;
                    const data = response.data;
                    data.forEach(item => {

                        item["start_attendance"] = converTime(item["start_attendance"]);
                        item["end_attendance"] = converTime(item["end_attendance"]);
                        item["start_date"] = convertDate(item["start_date"]);
                        item["event_attendance_checker"] = item.event_attendance_checker.length;
                    });
                    console.log(response.data);
                    this.events = response.data
                })
                .catch(error => {
                    // this.loading = false;
                    console.log(error)
                });
        },

        startAttendance(event_id, org_id, session, attendance_log_started) {
            // if (event_id === null || org_id === null || session === null) {
            //     // console.error('Error: One or more parameters are null');
            //     if(session == null){
            //         alert('Please Select Attendance Type.');
            //     }
            //     // You can handle the error here, such as displaying a message to the user
            //     return; // Exit the method early if there's an error
            // }
            // else{
            //      //query for qr scanner with event_id
            axios.post(`/upload_event_attendance_checker/${this.event_id}`)
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(error)
                });
            window.location.href = `student_qrscanner/${event_id}/${org_id}/${session}/${attendance_log_started}`;
            // }

        },

    }
}
</script>

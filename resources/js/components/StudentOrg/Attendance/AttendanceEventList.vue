<template>
    <div class="schedule-list-container">
    <div class="card" v-for="event in this.events" :id="event.event_id">
        <div class="card-header">
            <b> Event Name: {{ event["name"] }}</b>
        </div>
        <div class="card-body d-flex justify-content-between align-items-start">
            <div>
            <h5 class="card-title">Start Date: {{ event["start_date"] }}</h5>
            <p class="card-text">Time starts at: {{ event["start_attendance"] }}</p>
            </div>
            <div class="ml-auto">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#startAttendanceModal" @click="this.event_id = event['event_id'], this.attendanceCount()" >Start Attendance</button>
            </div>
        </div>
    </div>

    <!-- Start Attendance Modal -->
    <div class="modal fade" id="startAttendanceModal" tabindex="-1" aria-labelledby="startAttendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to start attendance?</p>
            <div class="form-group">
                        <label for="attendanceType">Select Attendance Type:</label>
                        <select class="form-select" id="attendanceType">
                                <option value="morning" v-if="this.event_id == 0">Morning (Log in)</option>
                                <option value="morning">Morning (Log out)</option>
                                <option value="afternoon">Afternoon (Log in)</option>
                                <option value="afternoon">Afternoon (Log out)</option>
                        </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" @click="startAttendance(this.event_id, this.org_id, 1)" >Start</button>
        </div>
        </div>
    </div>
    </div>
</div>
</template>


<script>

import {convertDate} from "../Functions/DateConverter.js";

export default {
    props: ['org_id'],
    data() {
        return {
            event_count:0,
            events: [],
            event_id: 0,

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
                    this.event_count = response.data;
                    console.log(this.event_count)
                    
                    
                })
                .catch(error => {

                });

    },
        fetchData() {
            // document.getElementById("event-spinner").show();
            fetch(`/events/show/${this.org_id}`, {
                method: "GET",
                headers: {
                    //TYPE OF DATA THAT THE SERVER SHOULD RESPOND
                    "Content-Type":"application/json"
                }
            }).then( (response) => {
                // document.getElementById("event-spinner").classList.add("hidden");
                response.json().then((data) => {
                    data.forEach(element => {
                        // console.log(element);
                        // console.log(element[])
                        element["start_date"] = convertDate(element["start_date"]);
                        element["end_date"] = convertDate(element["end_date"]);
                    });
                    this.events = data;
                })
            })
        },
        startAttendance(event_id, org_id, session){
            //query for qr scanner with event_id
            window.location.href = `student_qrscanner/${event_id}/${org_id}/${session}`;
        }
    }
}
</script>

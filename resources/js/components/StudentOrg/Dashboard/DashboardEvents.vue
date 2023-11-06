<template>
    <div class="Schedule-event" v-for="event in this.events" :id="event.event_id">
        <div class="Schedule-event-title"><h5> {{ event["name"] }}</h5></div>
        <div class="Schedule-event-details">
            <small>From: {{ event["start_date"] }} <br> To:  {{ event["end_date"] }}, {{ event["start_attendance"] }} - {{ event["end_attendance"] }}</small>
        </div>
    </div>

    <!-- <div class="list-group"  v-for="event in this.events" :id="event.event_id">
            <div class="list-group-item">
                <h6 class="mb-0">Event name: <b> {{ event["name"] }}</b></h6>
                <small> From:  {{ event["start_date"] }} To:  {{ event["end_date"] }} , {{ event["start_attendance"] }} - {{ event["end_attendance"] }} </small>
            </div>
    </div> -->
</template>

<script>
import {convertDate} from "../Functions/DateConverter.js";

export default {
    props: ['target_route'],
    data() {
        return {
            events: []
        }
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            fetch('/events/show', {
                method: "GET",
                headers: {
                    //TYPE OF DATA THAT THE SERVER SHOULD RESPOND
                    "Content-Type":"application/json"
                }
            }).then( (response) => {
                response.json().then((data) => {
                    data.forEach(element => {
                        element["start_date"] = convertDate(element["start_date"]);
                        element["end_date"] = convertDate(element["end_date"]);
                    });
                    this.events = data;
                })
            })
        },
    }
}
</script>

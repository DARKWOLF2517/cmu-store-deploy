<template>
    <div class="timeline-body">
       <!-- Message if the container is empty -->
       <div class="Container-IfEmpty" v-if="this.events.length === 0">
                                    <div class="Empty-Message">
                                    <i class="icon 	bi bi-calendar-event" id="icon-message"></i>
                                    <p><b>Create Events when you're ready</b></p>
                                    <p class="text-muted">No events yet.</p>
                                </div>
                                </div>
        <ul class="sessions">
            <li v-for="event in this.events" :id="event.event_id">
                <div class="date">{{ event.start_date }}</div>
                <small>{{ event.name }}</small>
            </li>
            <!-- <li>
                <div class="date">September 30, 2023</div>
                <small>Bayanihan</small>
            </li>
            <li>
                <div class="date">September 20, 2023</div>
                <small>Palaro</small>
            </li>
            <li>
                <div class="date">July 30, 2023</div>
                <small>General Assembly</small>
            </li>
            <li>
                <div class="date">July 30, 2023</div>
                <small>General Assembly</small>
            </li> -->
        </ul>
    </div>
</template>

<script>
import {convertDate} from "../Functions/DateConverter.js";

export default {
    props: ['organization_id'],
    data() {
        return {
            events: []
        }
    },
    mounted(){
        console.log('asdf')
        this.fetchData()
    },
    methods: {
        fetchData(){


                axios.get(`/events/show/${this.organization_id}`)
                .then(response => {
                    // console.log(response.data)
                    const events = response.data;
                    // Sort the events by start_date
                    events.sort((a, b) => {
                        const dateA = new Date(a.start_date);
                        const dateB = new Date(b.start_date);
                        return dateA - dateB;
                    });
                    this.events = events;

                })
                .catch(error => {
                    console.log('error')
                });



            },

    }
}
</script>

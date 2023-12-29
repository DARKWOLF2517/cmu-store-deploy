<template>
    <FullCalendar
    :options="calendarOptions"
    :events ="events"
    @eventClick="eventClick"   />
    <!-- Bootstrap Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Title:</strong> <span id="eventTitle"></span></p>
                    <p><strong>Start:</strong> <span id="eventStart"></span></p>
                    <p><strong>End:</strong> <span id="eventEnd"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import { Modal } from 'bootstrap'
import axios from 'axios'
export default {

    components: {
        FullCalendar // make the <FullCalendar> tag available
    },
    props: ['org_id'],
    data() {
        return {
            events: [],

            calendarOptions: {
                plugins: [ dayGridPlugin, interactionPlugin ],
                initialView: 'dayGridMonth',
                eventClick: this.eventClick,
                events: [
                    // { title: 'event 1', start: '2023-09-01' + 'T08:00:00', end: '2023-09-02' + 'T17:00:00'},
                    ],
            },

        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData(){
                axios.get(`/calendar/${this.org_id}`)
                    .then(response => {
                        this.calendarOptions.events = response.data;
                    })
                    .catch(error => {

                    });

        },
        eventClick: function(info){


            // Display event details in the modal
            document.getElementById('eventTitle').textContent = info.event.title;
            document.getElementById('eventStart').textContent = info.event.start;
            document.getElementById('eventEnd').textContent = info.event.end;

            // Show the modal
            let modal = new Modal(document.getElementById('eventModal'));
            modal.show();
        }
    }
}
</script>

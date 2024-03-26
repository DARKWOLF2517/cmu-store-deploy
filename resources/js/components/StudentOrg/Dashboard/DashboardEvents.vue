<template>
  <div v-if="loading" class="loading-spinner-dashboard">
    <div class="load-center">
      <div class="spinner-border text-success" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </div>
  <div v-else>
    <div class="timeline-body ">
      <div v-if="events.length === 0" class="Message-IfEmpty">
        <i class="icon far fa-calendar-times" id="icon-message"></i>
        <p class="empty-schedule">Nothing scheduled yet</p>
      </div>
      <ul v-else class="sessions">
        <li v-for="event in events" :key="event.event_id">
          <div class="date">{{ event.start_date }}</div>
          <small class="text-success"> <b>{{ event.name }}</b> </small> <br>
          <small class="text-success"> <b>{{ event.organization.description }}</b> </small>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { convertDate } from '../Functions/DateConverter.js';

export default {
  props: ['organization_id', 'school_year_session', 'student'],
  data() {
    return {
      events: [],
      loading: true,
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      if (this.student == true) {
        axios
          .get(`/events_student_dashboard/${this.school_year_session}`)
          .then((response) => {
            console.log(response.data)

            //convert date to specific format that is readable
            response.data.forEach(element => {
              element["start_date"] = convertDate(element["start_date"]);
            });

            this.events = response.data;
          })
          .catch((error) => {
            console.error('Error fetching data:', error);
          })
          .finally(() => {
            this.loading = false;
          });
      }
      else {
        axios
          .get(`/events/show/${this.organization_id}/${this.school_year_session}`)
          .then((response) => {
            console.log(response.data)

            //convert date to specific format that is readable
            response.data.forEach(element => {
              element["start_date"] = convertDate(element["start_date"]);
            });

            this.events = response.data;
          })
          .catch((error) => {
            console.error('Error fetching data:', error);
          })
          .finally(() => {
            this.loading = false;
          });
      }

    },
  },
};
</script>

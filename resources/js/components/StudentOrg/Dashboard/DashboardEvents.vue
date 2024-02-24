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
          <small class="text-success"> <b>{{ event.name }}</b> </small>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { convertDate } from '../Functions/DateConverter.js';

export default {
  props: ['organization_id', 'school_year_session'],
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
  axios
    .get(`/events/show/${this.organization_id}/${this.school_year_session}`)
    .then((response) => {
      console.log(response.data)

      //convert date to specific format that is readable
      const data = response.data;
      data.forEach(element => {
        element["start_date"] = convertDate(element["start_date"]);
      });
      //sort event chronologically
      const events = data;
      events.sort((a, b) => {
        const dateA = new Date(a.start_date);
        const dateB = new Date(b.start_date);
        //sort from newest to oldest
        return dateB - dateA;
      });
      this.events = events;
    })
    .catch((error) => {
      console.error('Error fetching data:', error);
    })
    .finally(() => {
      this.loading = false;
    });
},
  },
};
</script>

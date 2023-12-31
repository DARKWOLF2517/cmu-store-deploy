<template>
    <div class="recorded-event-cards">
      <!-- Loading spinner -->
      <div v-if="loading" class="loading-spinner-container">
        <div class="spinner-border text-success" id="event-spinner" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>

      <!-- Message if the container is empty -->
      <div v-if="!loading && Object.keys(attendance).length === 0" class="Container-IfEmpty">
        <div class="Empty-Message">
          <i class="icon fas fa-file-alt" id="icon-message"></i>
          <p class="text-muted"><b>No Attendance Recorded yet</b><br>Attendance records show up here.</p>
        </div>
      </div>

      <!-- Render attendance records -->
      <div v-if="!loading && Object.keys(attendance).length > 0" class="record-card" :id="attendance.event_id">
        <div class="record-date-container"><span class="event-date">{{ attendance.start_date }}</span></div>
        <div class="record-title"><h5><b>{{ attendance.name }}</b></h5></div>
        <div class="record-description">Number of Attendance recorded: <b>{{ attendance.attendance }}</b></div>
        <button v-if="attendance.attendance !== 0" class="view-button" @click="attendance_result(attendance.event_id)">
          <i class="fas fa-chevron-right button-icon"></i>
        </button>
      </div>
    </div>
  </template>

  <script>
  export default {
    props: ['organization_id'],
    data() {
      return {
        attendance: {},
        loading: true,
      };
    },

    mounted() {
      this.fetchData();
    },
    methods: {
      fetchData() {
        axios
          .get(`/attendance_record/${this.organization_id}`)
          .then((response) => {
            const data = response.data;
            const nonEmptyRecords = data.filter(item => item.attendance.length > 0);

            if (nonEmptyRecords.length > 0) {
              const firstItem = nonEmptyRecords[0];
              firstItem.attendance = firstItem.attendance.length;
              this.attendance = firstItem;
            }
          })
          .catch((error) => {
            console.log('error');
          })
          .finally(() => {
            // Set loading to false once data is fetched, whether successful or not
            this.loading = false;
          });
      },
      attendance_result(event_id) {
        window.location.href = `student_organization_attendance_record/${event_id}`;
      },
    },
  };
  </script>

<!--
<template>

   <div class="record-card" v-for="attendance in this.attendance" :id="attendance.event_id">
       <div class="record-date-container"><span class="event-date">{{attendance['start_date']}}</span></div>
       <div class="record-title"><h5> <b> {{ attendance['name'] }}</b></h5></div>
       <div class="record-description">Number of Attendance recorded: <b>{{attendance['attendance']}}</b></div>
       <button v-if="attendance['attendance'] != 0"  class="view-button" @click="attendance_result(attendance.event_id)"> <i class="fas fa-chevron-right button-icon"></i></button>
   </div>
</template>


<script>
export default{
   props: ['organization_id'],
   data() {
       return {
           attendance: {

           },

       }
   },

   mounted() {
       this.fetchData();
   },
   methods: {
       fetchData(){
           //TO BE FIX TOMORROW
           // console.log(this.evaluation_count)
           axios.get(`/attendance_record/${this.organization_id}`)
           .then(response => {
               // console.log(response.data)
               const data = response.data;
               data.forEach(item => {
                       item['attendance'] =  item['attendance'].length;

               });
               this.attendance = data;
           })
           .catch(error => {
               console.log('error')
           });

       },
       attendance_result(event_id){

           // window.location.href = `student_organization_attendance_record/${event_id}`;
           window.location.href = `student_organization_attendance_record/${event_id}`;
       },
   },

}
</script> -->

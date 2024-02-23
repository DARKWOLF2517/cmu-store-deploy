<template>

            <div class="col-md breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/org_dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item">Student Organization</li>
                    <li class="breadcrumb-item active" aria-current="page">Attendance</li>
                    <li class="breadcrumb-item active" aria-current="page">Attendance Records</li>
                    </ol>
                </nav>
            </div>
            <div class="mt-2">
                <div class="row head-container">
                    <div class="col-md-6 col-sm-12">
                        <div class="input-container">
                            <i class="fa fa-search"></i>
                            <input type="text" placeholder="Search Event" v-model="searchTerm" @input="filterItems">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">

                        <div class="select-dropdown" style="width: 70%;">
                        <select id="sort-select" class="form-control" style="text-align: center;" v-model="school_year_input"  @change="fetchData">
                            <option value="0" disabled selected>Select School Year</option>
                            <option v-for="school_year in this.school_year" :value="school_year['id']" >{{ school_year['school_year'] }}</option>
                        </select>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mt-2">
                <h4><i class="fas fa-list"></i> Attendance Records</h4>
            </div>
            <div class="col" id="record-container">
                <!-- Loading spinner -->
                <div v-if="loading" class="loading-spinner-container">
                    <div class="spinner-border text-success" id="event-spinner" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    </div>

                    <!-- Message if the container is empty -->
                    <div  class="Container-IfEmpty text-center" v-if="!loading && Object.keys(attendance).length === 0">
                        <div class="Empty-Message">
                            <i class="icon fas fa-file-alt" id="icon-message"></i>
                            <p class="text-muted"><b>No Attendance Recorded yet</b><br>Attendance records show up here.</p>
                        </div>
                    </div>
                    <!-- Message No results found -->
                    <div class="Container-IfEmpty text-center" v-if="!loading && this.filtered_attendance.length == 0 && Object.keys(attendance) != 0">
                        <div class="Empty-Message">
                            <i class="icon 	fas fa-frown" id="icon-message"></i>
                            <p class="text-muted fw-bold">No results found</p>
                        </div>
                    </div>
                <div class="recorded-event-cards">

                    <!-- Render attendance records -->
                    <div v-for="attendance_list in this.filtered_attendance" class="record-card" :id="attendance.event_id">
                        <div class="record-date-container"><span class="event-date">{{ attendance_list.start_date }}</span></div>
                        <div class="record-title"><h5><b>{{ attendance_list.name }}</b></h5></div>
                        <div class="record-description">Number of Attendance recorded: <b>{{ attendance_list.attendance }}</b></div>
                        <button v-if="attendance_list.attendance !== 0" class="view-button" @click="attendance_result(attendance_list.event_id)">
                            <i class="fas fa-chevron-right button-icon"></i>
                        </button>
                    </div>
                </div>
            </div>

</template>

  <script>
  import {convertDate} from "../Functions/DateConverter.js";

  export default {
    props: ['organization_id','school_year_session'],
    data() {
      return {
        attendance: [],
        loading: true,
        searchTerm: '',
        filtered_attendance: [],
        school_year_input: this.school_year_session,
        school_year: []
      };
    },

    mounted() {
      this.fetchData();
      this.showSchoolYear()
      // console.log(this.school_year)
    },
    methods: {
      showSchoolYear(){
        axios.get(`get_school_year`)
            .then(response => {
                // console.log(response.data)
                this.school_year = response.data;
            })
            .catch(error => {
                console.log(error)
            });
        },

      fetchData() {
        this.loading = true;
        this.attendance = [],
        this.filtered_attendance = [];
        axios.get(`/attendance_record/${this.organization_id}/${this.school_year_input}`)
          .then((response) => {
            // console.log(response.data)
            const data = response.data;
            data.forEach(element => {
              element['attendance'] = (element['attendance'].length)
            });
            data.forEach(item => {
                            item["start_date"] = convertDate(item["start_date"]);
                        });
            this.attendance = response.data;
            this.filtered_attendance = this.attendance;
            // const nonEmptyRecords = data.filter(item => item.attendance.length > 0);

            // if (nonEmptyRecords.length > 0) {
            //   const firstItem = nonEmptyRecords[0];
            //   firstItem.attendance = firstItem.attendance.length;
            //   this.attendance = firstItem;

            // }
            this.loading = false;
          })
          .catch((error) => {
            console.log(error);
          })
          // .finally(() => {
          //   // Set loading to false once data is fetched, whether successful or not
          //   this.loading = false;
          // });
      },
      filterItems() {
        // console.log(this.attendance)
          // Filter based on searchTerm from textbox
          let filtered = this.attendance;
          if (this.searchTerm) {
            const searchTermLower = this.searchTerm.toLowerCase();
            filtered = filtered.filter(item =>
                item.name.toLowerCase().includes(searchTermLower)
            );
          }
              this.filtered_attendance = filtered;
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

<template>
        <div class="record-card" v-for="attendance in this.attendance" :id="attendance.event_id">
            <!-- <h5> {{ evaluation['event_id'] }}</h5> -->
            <div class="record-date-container"><span class="event-date">{{attendance['start_date']}}</span></div>
            <div class="record-title">{{ attendance['name'] }}</div>
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
                // evaluation_count: 1,

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
</script>

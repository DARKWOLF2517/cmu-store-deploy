<template>
        <div class="event-card" v-for="evaluation in this.evaluation" :id="evaluation.event_id">
            <!-- <h5> {{ evaluation['event_id'] }}</h5> -->
            <div class="dropdown">
                <a class="ellipsis-button" href="#" role="button" id="ellipsisDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                    <!-- option 1 -->

                    <li><a class="dropdown-item" @click="UpdateAttendanceStatus(evaluation.event_id,'1')">Start Evaluation</a></li>
                    <!-- option 2 -->
                    <li><a class="dropdown-item" @click="UpdateAttendanceStatus(evaluation.event_id,'0')">Stop Evaluation</a></li>
                    <!-- Add more dropdown items as needed -->
                </ul>
            </div>
            <div class="event-date-container"><span class="event-date">{{evaluation['start_date']}}</span></div>
            <div class="event-title">{{ evaluation['name'] }}</div>
            <div class="event-description">Total Response: <b>{{evaluation['evaluation_form_answer']}}</b></div>
            <div>
                <div class="event-status" v-if="evaluation['status'] == 0">Status: <b>Closed</b> </div>
                <div class="event-status" v-else="evaluation['status'] == 1">Status: <b>Ongoing</b></div>
            </div>

            <button v-if="evaluation['evaluation_form_answer'] !== 0"  class="view-button" @click="evaluation_result(evaluation.event_id)"> <i class="fas fa-chevron-right button-icon"></i></button>
        </div>
</template>

<script>
    export default{
        props: ['organization_id'],
        data() {
            return {
                evaluation: {

                },
                // evaluation_count: 1,

            }
        },

        mounted() {
            this.fetchData();
        },
        methods: {
            fetchData(){
                // console.log(this.evaluation_count)
                axios.get(`/evaluation_list/${this.organization_id}`)
                .then(response => {
                    const data = response.data;
                    data.forEach(item => {

                    // console.log(item);
                    item['evaluation_form_answer'] =  item['evaluation_form_answer'].length;
                    });
                    this.evaluation = response.data;
                })
                .catch(error => {
                    console.log('error')
                });

            },
            evaluation_result(event_id){

                window.location.href = `evaluation_form_summary/${event_id}`;
            },

            UpdateAttendanceStatus(event_id,status) {
                axios.put(`/attendance/${event_id}/${status}`)
                    .then(response => {
                        // After update, axios post for calculating fines
                        location.reload();
                    })
                    .catch(error => {
                        alert('Error', error)
                    });
        },
        },

    }
</script>

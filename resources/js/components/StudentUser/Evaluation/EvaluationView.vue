<template>
        <div class="container mb-3" id="tablecontainer" v-for="(event , index) in this.events" :id="event.event_id">
                <h5> <span class="text-muted">Event name:</span>  <b>{{ event["name"] }} </b></h5>
                <!-- <h6> Number of Days: 2</h6>
                <h6> Total number of Attendance made: 4 </h6> -->
                <table class="mt-4">
                    <thead >
                        <!-- <tr>
                            <th class="sortable-header center" colspan="5">September 3, 2023</th>
                        </tr> -->
                        <tr>
                            <th class="sortable-header">Log in</th>
                            <th class="sortable-header"> Log out</th>
                            <th class="sortable-header">Log in</th>
                            <th class="sortable-header"> Log out</th>
                            <th class="sortable-header"> Evaluation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="present">Present</td>
                            <td class="present">Present</td>
                            <td class="present">Present</td>
                            <td class="present">Present</td>
                            <td>

                                        <!-- <div> {{ this.user_answer_student_id }}</div> -->
                                        <!-- Check if this.evaluation_answer is defined -->
                                        <div v-if="this.user_answer_student_id.length > 0">

                                            <div v-if = "hasResponded(event['event_id'])"> You Already Responded</div>
                                            <div v-else-if ="event['evaluation_status'] == 0 ">Evaluation is unavailable at the moment..</div>
                                            <button class="btn btn-warning" @click="this.showEvaluationForm(event.event_id)" v-else-if ="event['evaluation_status'] == 1"> Evaluate </button>
                                        </div>
                                        <div v-else>
                                            <div v-if ="event['evaluation_status'] == 0">Evaluation is unavailable at the moment..</div>
                                            <button class="btn btn-warning" @click="this.showEvaluationForm(event.event_id)" v-else-if ="event['evaluation_status'] == 1"> Evaluate</button>
                                        </div>

                                </td>

                        </tr>
                    </tbody>
                </table>
            </div>



</template>

<script>
export default {
    props: ['organization_id','student_id'],
    data() {
        return {
            events: [],
            user_answer_student_id:[],

        }
    },
    mounted() {
        this.fetchData();
        this.getEvaluationStatus()

    },
    methods: {
        hasResponded(eventId) {
            // Check if any element in user_answer_student_id has a matching event_id
            return this.user_answer_student_id.some(item => item.event_id === eventId);
        },
        fetchData(){
                axios.get(`/events/show/${this.organization_id}`)
                .then(response => {
                    this.events = response.data;
                    console.log(this.events)
                })
                .catch(error => {
                    console.log(error)
                });

            },
        getEvaluationStatus(){
            axios.get(`/evaluation/user/status/${this.student_id}`)
            .then(response => {
                // console.log(response.data)
                this.user_answer_student_id = response.data;
                // if (console.data == '0'){

                // }
                // else{


                // }
            })
            .catch(error => {
                console.log(error)
            });

        },
        showEvaluationForm(event_id){
            window.location.href = `evaluation_form/${event_id}`;

        },
    }
}
</script>

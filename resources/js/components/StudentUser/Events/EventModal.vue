<template>
        <div class="container mb-3" id="tablecontainer" v-for="event in this.events" :id="event.event_id"> 
                <h4> Event name: {{ event["name"] }}</h4>
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
                            <td class="present">Pending</td>
                            <td class="present">Pending</td>
                            <td class="present">Pending</td>
                            <td class="present">Pending</td>
                            <td>
                                
                                    <div>
                                        <!-- Check if this.evaluation_answer is defined -->
                                        <div v-if="this.evaluation_answer.length > 0">
                                            <div v-if = "this.evaluation_answer[0]['event_id'] == event['event_id']"> You Already Responded</div>
                                            <div v-else-if ="event['status'] == 0">Evaluation is disable at the moment..</div>
                                            <button class="btn btn-warning" @click="this.showEvaluationForm(event.event_id)" v-else-if ="event['status'] == 1"> Evaluate</button>
                                        </div>
                                        <div v-else>
                                            <div v-if ="event['status'] == 0">Evaluation is disable at the moment..</div>
                                            <button class="btn btn-warning" @click="this.showEvaluationForm(event.event_id)" v-else-if ="event['status'] == 1"> Evaluate</button>
                                        </div>
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
            evaluation_answer:[],
        }
    },
    mounted() {
        this.fetchData();
        this.getEvaluatinStatus()

    },
    methods: {
        fetchData(){
                axios.get(`/events/show/${this.organization_id}`)
                .then(response => {
                    this.events = response.data;
                    // console.log(this.events)
                })
                .catch(error => {
                    console.log(error)
                });

            },
        getEvaluatinStatus(){
            axios.get(`/evaluation/user/status/${this.organization_id}`)
            .then(response => {
                this.evaluation_answer = response.data;
                // console.log ()
                 console.log()
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

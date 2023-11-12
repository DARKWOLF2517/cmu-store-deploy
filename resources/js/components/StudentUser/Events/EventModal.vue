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
                                <button class="btn btn-warning" @click="this.showEvaluationForm(event.event_id)" v-if="event['status'] == 1">Evaluate now</button>
                                <div v-else>Evaluation is disable at the moment..</div>
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
        }
    },
    created() {
        this.fetchData();
        // console.log(this.student_id)
    },
    methods: {
        fetchData(){
                axios.get(`/events/show/${this.organization_id}`)
                .then(response => {
                    // document.getElementById("event-spinner").classList.add("hidden");
  
                    this.events = response.data;
                })
                .catch(error => {
                    console.log(error)
                });

            },
        getEvaluatinStatus(){
            axios.get(`/evaluation/user/status/${this.organization_id}/${this.event_id}`)
            .then(response => {
                // document.getElementById("event-spinner").classList.add("hidden");

                this.events = response.data;
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

<template>
        <div class="container mb-3" id="tablecontainer" v-for="event in this.events" :id="event.event_id">
                <h4> Event name: {{ event["name"] }}</h4>
                <h6> Number of Days: 2</h6>
                <h6> Total number of Attendance made: 4</h6>
                <table class="mt-4">
                    <thead >
                        <tr>
                            <th class="sortable-header center" colspan="5">September 3, 2023</th>
                        </tr>
                        <tr>
                            <th class="sortable-header">Log in - 7:00 AM</th>
                            <th class="sortable-header"> Log out - 11:00 AM</th>
                            <th class="sortable-header">Log in - 1:00 PM</th>
                            <th class="sortable-header"> Log out - 4:00 PM</th>
                            <th class="sortable-header"> Evaluation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="present">Present</td>
                            <td class="present">Present</td>
                            <td class="absent">Absent</td>
                            <td class="absent">Absent</td>
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
    props: ['organization_id'],
    data() {
        return {
            events: [],
        }
    },
    created() {
        this.fetchData();
        // console.log("mounted")
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
        showEvaluationForm(event_id){
            window.location.href = `evaluation_form/${event_id}`;

        },
    }
}
</script>

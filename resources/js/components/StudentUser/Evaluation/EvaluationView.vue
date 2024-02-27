<template>
    <div id="evaluation-container">
        <div class="evaluation-event-cards">
            <!-- <div class="evaluation-list">
        <div class="evaluation-container" id="evaluation-container">
            <div class="evaluation-cards-list"> -->
            <div v-for="(event, index) in this.events" :id="event.event_id" :class="[
                'event-card',
                'border-top',
                'border-5',
                { 'border-warning': event.evaluation_status === 1, 'border-secondary': event.evaluation_status === 0 },
                'py-3'
            ]">

                <div class="card-body">
                    <div class="info">
                        <div class="d-flex align-items-center">
                            <!-- <img src="https://indonesiasatu.co.id/assets/themes/indonesiasatu/img/user.png"
                                alt="Profile Image" width="30" height="30" class="circular-image"> -->
                            <strong class="posted-by-title ml-2">{{ event.organization.name }}</strong>
                        </div>
                        <h5 class="card-title mt-2"><b>{{ event["name"] }} </b></h5>
                        <small class="date-upload text-muted">{{ event["start_date"] }}</small>
                        <h6 class="evaluation-status" v-if="event['evaluation_status'] === 1">Status: <b>Ongoing</b></h6>
                        <h6 class="evaluation-status text-muted" v-else-if="event['evaluation_status'] === 0">Status:
                            <b>Close</b></h6>
                    </div>


                    <div class="card-footer text-right buttons mt-2 d-flex justify-content-end">
                        <div v-if="this.user_answer_student_id.length > 0">

                            <div v-if="event['evaluation_status'] == 0">
                                <button class="btn btn-secondary">Close</button>
                            </div>
                            <div v-else-if="this.hasResponded(event['event_id'])">
                                <button class="btn btn-success">Responded</button>
                            </div>
                            <div v-else-if="event['evaluation_status'] == 1">
                                <button class="btn btn-warning"
                                    @click="this.showEvaluationForm(event.event_id, event.evaluation_form)">Evaluate</button>
                            </div>

                        </div>

                        <div v-else>
                            <div v-if="event['evaluation_status'] == 0">
                                <button class="btn btn-secondary">Unavailable</button>
                            </div>
                            <button class="btn btn-warning" @click="this.showEvaluationForm(event.event_id, event.evaluation_form)"
                                v-else-if="event['evaluation_status'] == 1">Evaluate</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->




    <!--
       <div class=" mb-3" id="tablecontainer" v-for="(event , index) in this.events" :id="event.event_id">
                <h5> <span class="text-muted">Event name:</span>  <b>{{ event["name"] }} </b></h5>
                <table class="mt-4">
                    <thead >

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
                            <td> -->

    <!-- <div> {{ this.user_answer_student_id }}</div> -->
    <!-- Check if this.evaluation_answer is defined -->
    <!-- <div v-if="this.user_answer_student_id.length > 0">

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
            </div> -->
</template>

<script>
import { convertDate } from "../../StudentOrg/Functions/DateConverter.js";
export default {
    props: ['organization_id', 'student_id'],
    data() {
        return {
            events: [],
            user_answer_student_id: [],

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
        fetchData() {
            axios.get(`/events/show/${this.organization_id}`)
                .then(response => {
                    this.events = response.data;
                    console.log(this.events)
                    // data.forEach(item => {
                    //     item["start_date"] = convertDate(item["start_date"]);
                    // });

                })
                .catch(error => {
                    console.log(error)
                });

        },
        getEvaluationStatus() {
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
        showEvaluationForm(event_id,evaluation_form_id) {

            window.location.href = `evaluation_form/${event_id}/${evaluation_form_id}`;

        },
    }
}
</script>

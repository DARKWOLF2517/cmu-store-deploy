<template>
    <div class="container" id="tablecontainer">
        <div class="col-md-3">
            <div class="sort">
            <select class="form-select custom-select-width">
                <option selected>Sort by</option>
                <option>1st semester events</option>
                <option>2nd semester events</option>
            </select>
            </div>
        </div>
        <br>

        <table class="table"  >
        <thead>
        <tr>
            <th >Events</th>
            <th>Date</th>
            <th>Status</th>
            <th>Evaluation status</th>
            <th>Remarks</th>
        </tr>
        </thead>
        <tbody v-for="event in this.events" :id="event.event_id">
        <tr>
            <td>{{ event["name"] }}</td>
            <td>{{ event["start_date"] }}</td>
            <td v-if="showDiv1">Present</td>
            <th v-if="showDiv1">Pending</th>
            <th><a  class="btn btn-warning" href ="/student_evaluationform">Evaluate Now</a></th>
            <!-- <th>Evaluated</th> -->
        </tr>

        </tbody>
    </table>
    </div>



</template>

<script>

import {convertDate} from "../../StudentOrg/Functions/DateConverter.js";
export default {

    props: ['target_route', 'show'],
    data() {
        return {
            events: [],
            count : 1,
            showDiv1 :this.show
        }
    },

    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            fetch(this.target_route, {
                method: "GET",
                headers: {
                    //TYPE OF DATA THAT THE SERVER SHOULD RESPOND
                    "Content-Type":"application/json"
                }
            }).then( (response) => {
                response.json().then((data) => {
                    data.forEach(element => {
                        // console.log(element);
                        // console.log(element[])
                        element["start_date"] = convertDate(element["start_date"]);
                        element["end_date"] = convertDate(element["end_date"]);
                        this.count  = this.count + 1
                    });
                    this.events = data;

                })
            })
        },
    }
}
</script>

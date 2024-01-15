<template>
    <form  @submit.prevent="this.submit"  id="EvaluationForm" >
        <div class="evaluation-header">
            <h5> <b>{{this.event_title['organization']}}</b></h5>
            <h2> Evaluation Form</h2>
            <h5> Name of Activity: <b>{{this.event_title['name']}}</b>  </h5>
            <h5>Date and Time: <b>{{this.event_title['start_attendance']}}</b></h5>
            <h5>Venue:  <b>{{this.event_title['location']}}</b></h5>
            <hr>
            <small> Dear Students,
                This assessment of the program/activity you have just attended. Please rate the activity/program in terms of the following criteria listed below. Your
                honest answer will help improve future activity. Indicate your response with a check mark (✓) to the following indicators of this form.</small>
            <div class="form-group">
                <h6 for="name">VARIABLES</H6>
                <small> 1 - Needs Improvement | 2 – Satisfactory  | 3 - Good | 4 - Very Good | 5 - Excellent</small>
            </div>
        </div>
        <hr>
        <div class="evaluation-body">
            <h6 class="text-center">PROGRAM/ACTIVITY</h6>
            <div class="mt-2">
                <label for="PA-1">Stimulates the interest of the students.</label>
                <select class="form-control" id="PA-1"  v-model="formData.q1">
                    <option disabled>Select choice</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Very Good</option>
                    <option value="3">3 - Good</option>
                    <option value="2">2 - Satisfactory</option>
                    <option value="1">1 - Needs Improvement</option>

                </select>
            </div>
            <div class="mt-4">
            <label for="PA-2">Provide equal opportunities to all students or
                participants.</label>
            <select class="form-control" id="PA-2" v-model="formData.q2">
                    <option disabled>Select choice</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Very Good</option>
                    <option value="3">3 - Good</option>
                    <option value="2">2 - Satisfactory</option>
                    <option value="1">1 - Needs Improvement</option>
            </select>
            </div>
            <div class="mt-4">
                <label for="PA-2">Enhance the learning experience of the students</label>
                <select class="form-control" id="PA-3" v-model="formData.q3">
                    <option disabled>Select choice</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Very Good</option>
                    <option value="3">3 - Good</option>
                    <option value="2">2 - Satisfactory</option>
                    <option value="1">1 - Needs Improvement</option>>
                </select>
            </div>
            <div class="mt-4">
                <label for="PA-2">Help in recognizing and developing students’ inner
                    skills such as leadership qualities, creative and
                    innovative skills, etc.</label>
                <select class="form-control" id="PA-4" v-model="formData.q4">
                    <option disabled>Select choice</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Very Good</option>
                    <option value="3">3 - Good</option>
                    <option value="2">2 - Satisfactory</option>
                    <option value="1">1 - Needs Improvement</option>
                </select>
            </div>
            <div class="mt-4">
                <label for="PA-2">Help in developing richer learning experiences by
                    giving the students chance to think in new ways to
                    solve a problem or answer a question.</label>
                <select class="form-control" id="PA-5" v-model="formData.q5">
                    <option disabled>Select choice</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Very Good</option>
                    <option value="3">3 - Good</option>
                    <option value="2">2 - Satisfactory</option>
                    <option value="1">1 - Needs Improvement</option>
                </select>
            </div>
            <div class="mt-4">
                <label for="PA-2">Satisfy students’ need to take time outs to do more
                    than just studying.</label>
                <select class="form-control" id="PA-6" v-model="formData.q6">
                    <option disabled>Select choice</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Very Good</option>
                    <option value="3">3 - Good</option>
                    <option value="2">2 - Satisfactory</option>
                    <option value="1">1 - Needs Improvement</option>
                </select>
            </div>
            <div class="mt-4">
                <label for="PA-2">Give students a chance to relax, refresh and
                    mingle easily with others.</label>
                <select class="form-control" id="PA-7" v-model="formData.q7">
                    <option disabled>Select choice</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Very Good</option>
                    <option value="3">3 - Good</option>
                    <option value="2">2 - Satisfactory</option>
                    <option value="1">1 - Needs Improvement</option>
                </select>
            </div>
            <div class="mt-4">
                <label for="PA-2">Provide opportunity for students to apply learning
                    in their practical life.</label>
                <select class="form-control" id="PA-8" v-model="formData.q8">
                    <option disabled>Select choice</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Very Good</option>
                    <option value="3">3 - Good</option>
                    <option value="2">2 - Satisfactory</option>
                    <option value="1">1 - Needs Improvement</option>
                </select>
            </div>
            <div class="mt-4">
                <label for="PA-2">Provide opportunity for student to work in team.</label>
                <select class="form-control" id="PA-9" v-model="formData.q9">
                    <option disabled>Select choice</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Very Good</option>
                    <option value="3">3 - Good</option>
                    <option value="2">2 - Satisfactory</option>
                    <option value="1">1 - Needs Improvement</option>
                </select>
            </div>
            <h6 class="text-center mt-4">VENUE</h6>
            <div class="mt-2">
                <label for="V-1">The venue was accessible and comfortable</label>
                <select class="form-control" id="V-1" v-model="formData.q10">
                    <option disabled>Select choice</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Very Good</option>
                    <option value="3">3 - Good</option>
                    <option value="2">2 - Satisfactory</option>
                    <option value="1">1 - Needs Improvement</option>
                </select>
            </div>
            <h6 class="text-center mt-4">PARTICIPATION</h6>
            <div class="mt-2">
                <label for="P-1">Attendance</label>
                <select class="form-control" id="P-1" v-model="formData.q11">
                    <option disabled>Select choice</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Very Good</option>
                    <option value="3">3 - Good</option>
                    <option value="2">2 - Satisfactory</option>
                    <option value="1">1 - Needs Improvement</option>
                </select>
            </div>
            <div class="mt-2">
                <label for="P-2">Cooperation</label>
                <select class="form-control" id="P-2" v-model="formData.q12">
                    <option disabled>Select choice</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Very Good</option>
                    <option value="3">3 - Good</option>
                    <option value="2">2 - Satisfactory</option>
                    <option value="1">1 - Needs Improvement</option>
                </select>
            </div>
            <div class="mt-2">
                <label for="P-3">Punctuality</label>
                <select class="form-control" id="P-3" v-model="formData.q13">
                    <option disabled>Select choice</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Very Good</option>
                    <option value="3">3 - Good</option>
                    <option value="2">2 - Satisfactory</option>
                    <option value="1">1 - Needs Improvement</option>
                </select>
            </div>
            <h6 class="text-center mt-4">FOOD/HOSPITALITY</h6>
            <div class="mt-2">
                <select class="form-control" id="FH-1" v-model="formData.q14">
                    <option disabled>Select choice</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Very Good</option>
                    <option value="3">3 - Good</option>
                    <option value="2">2 - Satisfactory</option>
                    <option value="1">1 - Needs Improvement</option>
                </select>
            </div>
            <h6 class="text-center mt-4">TEAMWORK/COORDINATION OF ORGANIZATION</h6>
            <div class="mt-2">
                <select class="form-control" id="TCO-1" v-model="formData.q15">
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Very Good</option>
                    <option value="3">3 - Good</option>
                    <option value="2">2 - Satisfactory</option>
                    <option value="1">1 - Needs Improvement</option>
                </select>
            </div>
            <div class="form-group mt-4">
                <label for="feedback">Please write below any suggestions/recommendations on how we can improve the Activity:</label>
                <textarea class="form-control" id="feedback" rows="3" placeholder="Enter your feedback" required  v-model="formData.q16"></textarea>
            </div >

            <div class="d-flex justify-content-end">
  <button type="submit" class="btn btn-success mt-2 mb-2 ml-auto">  Submit</button>
</div>

        </div>

    </form>
</template>

<script>
import {converTime} from "../../StudentOrg/Functions/TimeConverter.js";
export default {
        mounted() {
            // console.log(this.event_id)
            this.showEventTitle();

        },
        props: ['user_id', 'event_id', 'org_id'],
        data() {
            return {
                formData:{
                    event_id: this.event_id,
                    user_id: this.user_id,
                    org_id: this.org_id,
                    q1: '',
                    q2: '',
                    q3: '',
                    q4: '',
                    q5: '',
                    q6: '',
                    q7: '',
                    q8: '',
                    q9: '',
                    q10: '',
                    q11: '',
                    q12: '',
                    q13: '',
                    q14: '',
                    q15: '',
                    q16: '',
                },
                event_title: {
                name: '',
                organization: '',
                start_attendance:'',
                location: '',

            },
            }
        },
        methods: {
            submit(){
                console.log(this.formData);
                axios.post('/submit_evaluation', this.formData)
                    .then(response => {
                        window.location.href = "/student_evaluation_list"
                    })
                    .catch(error => {
                        alert(error)

                });
            },
            showEventTitle(){
            axios.get(`/evaluation_form_title/${this.event_id}`)
                .then(response => {
                    console.log(response.data)
                    const data = response.data;
                    data.forEach(item => {

                    // console.log(item);
                    item["start_attendance"] = converTime(item["start_attendance"]);
                    this.event_title['name'] =  item['name'];
                    this.event_title['organization'] =  item['organization']['name'];
                    this.event_title['start_attendance'] =  item['start_attendance'];
                    this.event_title['location'] =  item['location'];
                    });
                    console.log(this.event_title);


                })
                .catch(error => {
                    console.log(error)
                });
        },
        },

    }
</script>

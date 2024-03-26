<template>
    <div class="mt-4 p-2">
        <!-- Loading spinner for the form -->
        <div v-if="loading" class="loading-spinner-container">
            <div class="spinner-border text-success" id="form-spinner" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <form id="EvaluationForm" v-if="!loading">
            <div class="evaluation-header">
                <h5> <b>{{ this.event_title['organization'] }}</b></h5>
                <h2> {{ this.evaluation_with_questions_options.evaluation_title }}</h2>
                <h5> Name of Activity: <b>{{ this.event_title['name'] }}</b> </h5>
                <h5>Date and Time: <b>{{ this.event_title['start_attendance'] }}</b></h5>
                <h5>Venue: <b>{{ this.event_title['location'] }}</b></h5>
                <hr>
                <p> {{ this.event_title.description }}</p>
            </div>
            <hr>
            <div class="evaluation-body">
                <div class="mt-2" v-for="question in this.evaluation_with_questions_options.evaluation_question">
                    <!-- <p>{{ question.description }}</p>
                    <p v-for="answer in question.evaluation_answers"> </p> -->
                    <h5 :for="'PA-' + question.id">{{ question.description }}</h5>
                    <span class="card bg-light mt-2"  style="padding: 2px;">
                    <div v-for="answer in question.evaluation_option">

                        <p class="fw-bold mt-2" style="margin-left: 10px;" v-if="isChoicePresent(answer.id)"> {{ answer.option }} </p>

                    </div>
                </span>
                    <!-- <select  class="form-control" :id="'PA-' + question.id" v-model="formData.id" disabled>
                        <option v-for="option in question.evaluation_option" :value="question.id">
                            {{ option.option }}
                        </option>
                    </select> -->
                </div>



                <div class="form-group mt-4" v-if="evaluation_with_questions_options.is_accept_feedback == 1">
                    <label for="feedback">Feedback:</label>
                    <textarea class="form-control" id="feedback" rows="3" placeholder="Enter your feedback" required
                        v-model="this.word_answer" disabled></textarea>
                </div>

                <!-- <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success mt-4 mb-2 ml-auto h-50"
                        style="padding: 15px; width: 300px;" :disabled="isSubmitting"> Submit</button>
                </div> -->

            </div>

        </form>
    </div>
</template>

<script>
import { converTime } from "../../StudentOrg/Functions/TimeConverter.js";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default {
    mounted() {
        // console.log(this.event_id)
        this.fetchFeedback();
        this.showEventTitle();
        this.showQuestions();
        this.showChoiceAnswer();

    },
    props: ['user_id', 'event_id', 'org_id', 'evaluation_form_id'],
    data() {
        return {
            formData: {},
            feedback: '',
            event_title: {
                name: '',
                organization: '',
                start_attendance: '',
                location: '',
                description: '',

            },
            evaluation_with_questions_options: [],
            loading: true,
            isSubmitting: false,
            answers: [],
            word_answer: '',

        }
    },
    methods: {
        fetchFeedback() {
            axios
                .get(`/get_evaluation_feedback/${this.event_id}`)
                .then((response) => {
                    // console.log(response.data);
                    // this.feedback = response.data;
                    let filteredArray = response.data.filter(item => item.student_id == this.user_id);
                    this.word_answer =filteredArray[0].word_answer;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        isChoicePresent(id) {
            return this.answers.includes(id);
        },
        async showChoiceAnswer() {
            await axios.get(`/get_choice_name/${this.evaluation_form_id}/${this.event_id}`)
                .then(response => {

                    response.data.forEach(element => {

                        this.answers.push(element.evaluation_answers[0].option_id);
                    });
                    // this.loading = false;
                })
                .catch(error => {
                    console.log(error)
                    // this.loading = false;
                });
        },
        showEventTitle() {
            axios.get(`/evaluation_form_title/${this.event_id}`)
                .then(response => {
                    // console.log(response.data)
                    const data = response.data;
                    data.forEach(item => {

                        // console.log(item);
                        item["start_attendance"] = converTime(item["start_attendance"]);
                        this.event_title['name'] = item['name'];
                        this.event_title['organization'] = item['organization']['name'];
                        this.event_title['start_attendance'] = item['start_attendance'];
                        this.event_title['location'] = item['location'];
                        this.loading = false;
                    });
                    // console.log(this.event_title);


                })
                .catch(error => {
                    console.log(error)
                    this.loading = false;
                });
        },
        showQuestions() {
            axios.get(`/evaluation_form_result_student/${this.evaluation_form_id}/${this.event_id}`)
                .then(response => {
                    console.log(response.data.evaluation_question)
                    this.evaluation_with_questions_options = response.data;
                    this.event_title.description = response.data.evaluation_description;
                    this.loading = false;
                })
                .catch(error => {
                    console.log(error)
                    this.loading = false;
                });
        },
        showSucces(message) {
            toast.success(message), {
                autoClose: 100,
            }
        },
    },

}
</script>

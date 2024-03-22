    <template>
        <div class="mt-4 p-2">
            <!-- Loading spinner for the form -->
        <div v-if="loading" class="loading-spinner-container">
            <div class="spinner-border text-success" id="form-spinner" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <form @submit.prevent="this.submit" id="EvaluationForm" v-if="!loading">
            <div class="evaluation-header">
                <h5> <b>{{ this.event_title['organization'] }}</b></h5>
                <h2> {{ this.evaluation_with_questions_options.evaluation_title }}</h2>
                <h5> Name of Activity: <b>{{ this.event_title['name'] }}</b> </h5>
                <h5>Date and Time: <b>{{ this.event_title['start_attendance'] }}</b></h5>
                <h5>Venue: <b>{{ this.event_title['location'] }}</b></h5>
                <hr>
                <p> {{  this.event_title.description  }}</p>
            </div>
            <hr>
            <div class="evaluation-body">
                <div class="mt-2" v-for="question in this.evaluation_with_questions_options.evaluation_question">
                    <label :for="'PA-' + question.id">{{ question.description }}</label>
                    <select class="form-control" :id="'PA-' + question.id" v-model="formData[question.id]">
                        <option disabled>Select choice</option>
                        <option v-for="option in question.evaluation_option" :value="option.id">
                            {{ option.option }}
                        </option>
                    </select>
                </div>



                <div class="form-group mt-4" v-if="evaluation_with_questions_options.is_accept_feedback == 1">
                    <label for="feedback">Please write below any suggestions/recommendations on how we can improve the
                        Activity:</label>
                    <textarea class="form-control" id="feedback" rows="3" placeholder="Enter your feedback" required
                        v-model="this.feedback"></textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success mt-4 mb-2 ml-auto h-50" style="padding: 15px; width: 300px;" :disabled="isSubmitting"> Submit</button>
                </div>

            </div>

        </form>
    </div>
    </template>

    <script>
    import { converTime } from "../../StudentOrg/Functions/TimeConverter.js";
    export default {
        mounted() {
            // console.log(this.event_id)
            this.showEventTitle();
            this.showQuestions();

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
            }
        },
        methods: {
            submit() {
                // console.log(this.formData);
                this.isSubmitting = true;
                axios.post(`/submit_evaluation/${this.user_id}/${this.event_id}/${this.feedback}`, this.formData)
                    .then(response => {
                        console.log(response.data)
                        window.location.href = "/student_evaluation_list"
                    })
                    .catch(error => {
                        console.log(error)

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
                axios.get(`/get_evaluation_question/${this.evaluation_form_id}`)
                    .then(response => {
                        console.log(response.data)
                        this.evaluation_with_questions_options = response.data;
                        this.event_title.description = response.data.evaluation_description;
                        this.loading = false;
                    })
                    .catch(error => {
                        console.log(error)
                        this.loading = false;
                    });
            },
        },

    }
    </script>

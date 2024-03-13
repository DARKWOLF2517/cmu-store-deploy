<template>
    <div class="mt-2">
        <div class="row head-container">
            <div class="col-md-6 col-sm-12">
                <div class="input-container">
                    <i class="fa fa-search"></i>
                    <input type="text" placeholder="Search Form">
                </div>
            </div>
            <div class="col-md-6 col-sm-12" style="display: flex; align-items: center; gap: 20px;">
                <div class="select-dropdown" style="width: 70%;">
                    <select id="sort-select" class="form-control" style="text-align: center;"
                        v-model="school_year_input" @change="fetchEvaluationForms">
                        <option value="" disabled selected>Select Semester</option>
                        <option v-for="school_year in this.school_year" :value="school_year['id']">{{
                            school_year['school_year'] }}
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">

            <h3><i class="fas fa-list mt-2"></i> Evaluation Forms</h3>
            <div class="event-buttons d-flex">
                <div class="btn-group" role="group">
                    <button @click="this.submit = this.submitForm" class="btn me-2" id="add-event-button"
                        data-bs-toggle="modal" data-bs-target="#evaluation-modal"> <i class="fas fa-plus"></i>
                        Create form</button>
                </div>
            </div>
        </div>
    </div>
    <div id="evaluation-container">
    <div class="evaluation-event-cards">
        <!-- Loading spinner -->
        <div v-if="loading" class="loading-spinner-container">
            <div class="spinner-border text-success" id="event-spinner" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <!-- Message if the container is empty -->
        <div class="Container-IfEmpty text-center" v-if="!loading && this.evaluation_form.length == 0">
            <div class="Empty-Message">
                <i class="icon 	fas fa-folder" id="icon-message"></i>
                <p class="text-muted"><b>Evaluation is Empty</b>
                    <br>
                    Evaluation Cards show up here
                </p>
            </div>
        </div>

            <div class="event-card"
                style=" border-left-style: solid; border-left-color: #1b9587;"
                v-for="evaluation in this.evaluation_form">

                <div class="dropdown">
                    <a class="ellipsis-button" href="#" style="color: #3e505d;" role="button" id="ellipsisDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                        <!-- option 1 -->

                        <li><a class="dropdown-item">Set as Default</a></li>
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#evaluation-modal"
                                @click="this.submit = this.updateData, fetchEditData(evaluation.id)">Edit Form</a></li>
                        <!-- option 2 -->
                        <li @click="evaluation_form_id = evaluation.id"><a class="dropdown-item" data-bs-toggle="modal"
                                data-bs-target="#deleteConfirmation">Delete
                                Form</a></li>
                        <!-- Add more dropdown items as needed -->
                    </ul>
                </div>

                <div class="evaluation-title mt-4">
                    <h5> <b>{{ evaluation.evaluation_title }}</b></h5>
                </div>
                <div class="evaluation-description">Total Questions: <b>{{ evaluation.evaluation_question.length }}</b>
                </div>
                <div>
                    <div class="evaluation-status text-muted">Date Created <b>{{ evaluation.created_at }}</b>
                    </div>
                </div>
                <button class="btn btn-success view-button" data-bs-toggle="modal"
                    data-bs-target="#evaluation-form-modal" @click="this.viewEvaluationModal(evaluation.id)">
                    View</button>
                <!-- <button class="view-button"> <i class="fas fa-chevron-right button-icon"></i></button> -->
            </div>
        </div>
    </div>

    <!-- add evaluation form  -->
    <div class="modal fade" id="evaluation-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <form @submit.prevent="this.submit">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Evaluation Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="formTitle" class="form-label">Title of the Evaluation Form</label>
                            <input type="text" class="form-control" id="formTitle" v-model="formTitle" required
                                maxlength="50">
                        </div>
                        <div class="mb-3">
                            <label for="formDescription" class="form-label">Input Description</label>
                            <textarea class="form-control" id="formDescription" rows="3" v-model="formDescription"
                                required maxlength="200"></textarea>
                        </div>
                        <div class="d-flex justify-content-end mb-3">
                            <button type="button" class="btn btn-primary add-question" @click="this.addQuestion()"> <i
                                    class="fas fa-plus"></i> Add
                                Question</button>
                        </div>
                        <div class="question-container" style="height: 60vh; max-height: 60vh;  overflow-y: auto;">
                            <div class="mb-3" v-for="(question, questionindex) in questions" :key="questionindex">
                                <label for="question1" class="form-label fw-bold">Question {{ questionindex + 1
                                    }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" :id="'question' + (questionindex + 1)"
                                        :ref="'question' + (questionindex + 1)" v-model="question.text">
                                    <button class="btn btn-danger remove-question" type="button"
                                        @click="removeQuestion(questionindex)">X</button>
                                </div>
                                <div class="choice-container" style="padding-left: 15px;">
                                    <div class="d-flex justify-content-start mb-3 mt-2"> <button type="button"
                                            class="btn btn-secondary add-question" @click="addChoice(questionindex)">
                                            <i class="fas fa-plus"></i> Add
                                            Choice</button>
                                    </div>

                                    <div class="mb-3" v-for="(choice, index) in question.choices" :key="index">
                                        <label for="choice" class="form-label fw-bold">Choice {{ index + 1 }}</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" :id="'choice' + (index + 1)"
                                                :ref="'choice' + (index + 1)" v-model="choice.text">
                                            <button class="btn btn-danger remove-question" type="button"
                                                @click="removeChoice(questionindex, index)">X</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="feedback" v-model="this.acceptFeedback"
                                :true-value="1" :false-value="0">
                            <label for="feedback">Accept Feedback?</label>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save Form</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- View Evaluation Form Modal -->
    <div class="modal fade" id="evaluation-form-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" v-for="evaluation in this.filteredEvaluationFormForModal">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="exampleModalLabel">View Evaluation Form</h5> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                    <div class="mb-3">
                        <h3 for="formTitle" class="form-label">Evalution name: {{ evaluation.evaluation_title }}</h3>
                    </div>
                    <div>
                        <label for="formDescription">Description:</label>
                        <p style="padding-left: 10px;">{{ evaluation.evaluation_description }}</p>
                    </div>
                    <div class="mb-3" v-for="(question, index) in evaluation.evaluation_question">
                        <label for="question1" class="form-label fw-bold">Question {{ index + 1 }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="question1" :value="question.description"
                                readonly>
                        </div>
                        <div class="mb-3 form-check">
                            <div id="choicesContainer1" class="mt-2">
                                <label for="choices1">Choices</label>
                                <br>
                                <small class="fw-bold" v-for="(choices, index) in question.evaluation_option"> {{
                            String.fromCharCode(65 + index) }}. {{ choices.option }} &nbsp; </small>
                            </div>
                        </div>
                    </div>
                    <div class="feedback mb-3">
                        <label for="feedback">Accept Feedback?</label>
                        <small>Yes</small>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteConfirmation" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="deleteModalLabel">Delete Announcement</h5> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h4><i class="fas fa-exclamation-triangle text-warning"></i></h4>
                    <h4><b>Remove Evaluation Form</b></h4>
                    <p>Are you sure you want to remove this form?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" @click="this.deleteData()"
                        data-bs-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { convertDate } from "../Functions/DateConverter.js";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import axios from 'axios';

export default {
    props: ['organization_id', 'school_year_session'],
    data() {
        return {
            loading: true,
            submit: this.submitForm,
            evaluation_form_id: 0,
            questions: [{
                text: '',
                choices: [{
                    text: ''
                }],

            }],
            acceptFeedback: 0,
            school_year: [],
            school_year_input: this.school_year_session,
            formTitle: '',
            formDescription: '',
            evaluation_form: [],
            filteredEvaluationFormForModal: [],
        }
    },
    mounted() {
        this.fetchEvaluationForms();
        this.showSchoolYear();
    },
    methods: {
        showSchoolYear() {
            axios.get(`get_school_year`)
                .then(response => {
                    console.log(response.data)
                    this.school_year = response.data;
                })
                .catch(error => {
                    console.log(error)
                });
        },

        addQuestion() {
            this.questions.push({
                text: '',
                choices: [{
                    text: '',
                }]
            });
        },
        addChoice(questionIndex) {
            this.questions[questionIndex].choices.push({
                text: ''
            });
        },
        removeQuestion(index) {
            this.questions.splice(index, 1);
        },
        removeChoice(questionIndex, choiceIndex) {
            this.questions[questionIndex].choices.splice(choiceIndex, 1);
        },
        submitForm() {
            axios.post('/upload_evaluation_form', {
                title: this.formTitle,
                description: this.formDescription,
                questions: this.questions,
                org_id: this.organization_id,
                accept_feedback: this.acceptFeedback,
            })
                .then(response => {
                    console.log(response.data)
                    this.showSucces(response.data.message);
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                })
                .catch(error => {
                    console.log(error)
                });
        },
        deleteData() {
            axios.delete(`/delete_evaluation_form/${this.evaluation_form_id}`)
                .then(response => {
                    // console.log(response.data)
                    if(response.data.status == 1){
                        this.showSucces(response.data.message);
                        this.fetchEvaluationForms();
                    }
                    else{
                        this.showError(response.data.message);
                    }

                })
                .catch(error => {
                    if (error.response.status === 500) {
                        // Handle the 500 error (Internal Server Error)
                        console.log("Internal Server Error:", error.response.data);
                        // Add your error handling logic here
                    } else {
                        // Handle other errors
                        console.log("Error:", error.message);
                        // Add your error handling logic here
                    }
                });
        },
        fetchEditData(evaluation_id) {
            this.evaluation_form_id = evaluation_id;
            this.loading = true;

            axios.get(`/fetchEvaluationFormUpdate/${evaluation_id}`)
                .then(response => {
                    this.loading = false;
                    console.log(response.data)
                    let data = response.data.evaluation_question;
                    this.questions = [];
                    this.questions = data.map(element => {
                        let choices = element.evaluation_option.map(option => {
                            return {
                                text: option.option,
                                id: option.id // Add id property to each choice
                            };
                        });

                        return {
                            text: element.description,
                            id: element.id, // Add id property to the question
                            choices: choices
                        };
                    });

                    console.log(this.questions)
                    this.formTitle = response.data.evaluation_title;
                    this.formDescription = response.data.evaluation_description;
                    this.acceptFeedback = response.data.is_accept_feedback;
                })
                .catch(error => {
                    console.log(error)

                });
        },
        updateData() {
            axios.put('/updateEvaluationForm', {
                evaluation_form_id: this.evaluation_form_id,
                title: this.formTitle,
                description: this.formDescription,
                questions: this.questions,
                org_id: this.organization_id,
                accept_feedback: this.acceptFeedback,
            })
                .then(response => {
                    console.log(response.data)
                    this.showSucces(response.data.message);
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                })
                .catch(error => {
                    console.log(error)
                });
        },
        fetchEvaluationForms() {
            this.loading =true;
            axios.get(`/getEvaluationForm/${this.organization_id}`)
                .then(response => {
                    console.log(response.data)
                    response.data.forEach(item => {
                        item["created_at"] = convertDate(item["created_at"]);
                    });
                    this.evaluation_form = response.data;
                })
                .catch(error => {
                    console.log(error)
                });
                this.loading=false;
        },
        viewEvaluationModal(evaluation_id) {
            console.log(evaluation_id)
            this.filteredEvaluationFormForModal = this.evaluation_form.filter(form => form.id === evaluation_id);
            console.log(this.filteredEvaluationFormForModal)
        },
        showSucces(message) {
            toast.success(message), {
                autoClose: 1000,
            }
        },
        showError(message) {
            toast.error(message), {
                autoClose: 1000,
            }
        },
    }
}

</script>

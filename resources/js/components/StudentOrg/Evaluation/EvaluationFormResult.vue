<template>
    <!-- <h6>1. PROGRAM/ACTIVITY</h6> -->
    <div class="btn-group d-flex justify-content-end p-2" role="group">
        <div>
            <button class="btn me-2" id="print-results-button">
                <i class="fas fa-print"></i> Print Results
            </button>
            <button class="btn me-2" id="download-results-button">
                <i class="fas fa-download"></i> Download Results
            </button>
            <a class="btn me-2" href="/student_organization_evaluation_results_table">
                <i class="fas fa-eye"></i> View Table
            </a>
        </div>
    </div>
    <div class="col mt-2" id="evaluation-summary">
        <h3>STUDENT ORGANIZATIONS & ACTIVITIES EVALUATION FORM</h3>
        <hr>
        <h6 for="Activity">Event: <b>{{ this.event_description.event_name }}</b> </h6>
        <h6 for="StudentOrganization">Name of Organization: <b>{{this.event_description.org_name }}</b></h6>
        <h6 for="DateTime">Date <b>{{ this.event_description.date }}</b></h6>
        <h6 for="Venue">Venue: <b>{{ this.event_description.venue }}</b></h6>
        <div class="row">
            <div class="col" v-for="evaluation_questions in evaluation_question_id">
                <div class="piechart" :id="evaluation_questions.id"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-12 feedback">
                <h4>Feedbacks</h4>
                <div class="feedbacklist-card">
                    <ul class="list-group" id="evaluation-feedbacks">
                        <li class="list-group-item mb-2" v-for="feedbacks in this.feedback">{{ feedbacks.word_answer }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

import { convertDate } from "../Functions/DateConverter.js";
export default {
    props: ['event_id'],
    data() {
        return {
            evaluation_result: [],
            evaluation_question_id: [],
            feedback:[],
            event_description:{
                event_name:'',
                org_name: '',
                date: '',
                venue:'',
            },
        }
    },
    mounted() {
        this.fetchEvent();
        console.log('mounted')
        // this.pieChart();
        this.fetchAnswer();
        this.fetchFeedback();
       
    },
    methods: {
        fetchFeedback() {
            axios.get(`/get_evaluation_feedback/${this.event_id}`)
                .then(response => {
                    console.log(response.data);
                    this.feedback = response.data;
                })
                .catch(error => {
                    console.log(error)
                });
        },
        fetchEvent() {
            axios.get(`/get_events/${this.event_id}`)
                .then(response => {
                    console.log(response.data);
                    this.event_description.event_name = response.data.name;
                    this.event_description.org_name = response.data.organization.name;
                    this.event_description.date = convertDate(response.data.start_date);
                    this.event_description.venue = response.data.location;
                })
                .catch(error => {
                    console.log(error)
                });
        },
        fetchAnswer() {
            axios.get(`/evaluation_answer/${this.event_id}`)
                .then(response => {
                    this.evaluation_result = response.data;
                    this.evaluation_result.forEach(evaluation => {

                        evaluation.evaluation_question.forEach(question => {
                            this.evaluation_question_id.push({
                                id: question.id,
                            })
                            console.log(question);
                            let options = [];
                            let answers_temporary = [];
                            question.evaluation_option.forEach(option => {
                                options.push({
                                    option_id: option.id,
                                    option: option.option
                                })
                            });
                            question.evaluation_answers.forEach(element => {
                                answers_temporary.push({
                                    answers_option_id: element.option_id,
                                })
                            });
                            //to count the result per options
                            let combinedData = options.concat(answers_temporary);
                            let counts = {};

                            combinedData.forEach(item => {
                                if (item.option_id !== undefined) {
                                    5
                                    if (!counts[item.option_id]) {
                                        counts[item.option_id] = 0;
                                    }
                                } else { // It's an answers_temporary item
                                    // Ensure counts[item.answers_option_id] is initialized before incrementing
                                    if (!counts[item.answers_option_id]) {
                                        counts[item.answers_option_id] = 0;
                                    }
                                    counts[item.answers_option_id]++;
                                }
                            });

                            // Convert counts object to an array of objects
                            let answers = Object.entries(counts).map(([option_id, count]) => ({ option_id, count }));
                            this.$nextTick(() => {
                                this.pieChart(question.id, question.description, options, answers);
                            });

                        });
                    });
                })
                .catch(error => {
                    console.log(error)
                });
        },
        pieChart(question_id, question_description, question_options, question_answers) {
            // console.log('')
            // console.log(question_options)
            // console.log(question_id)
            google.charts.load('current', { 'packages': ['corechart'] });

            google.charts.setOnLoadCallback(() => {
                // Define the data array
                var dataArray = [];

                // Populate the data array with your dynamic data
                var options = question_options;
                var percentage = question_answers;
                // console.log(percentage)
                // Create a mapping between option_id and count from the percentage object
                var percentageMap = {};
                question_answers.forEach(item => {
                    percentageMap[item.option_id] = item.count;
                });

                // Populate the data array with dynamic data based on options and percentageMap
                question_options.forEach(option => {
                    var count = percentageMap[option.option_id] || 0; // Default to 0 if option_id not found
                    dataArray.push([option.option, count]);
                });
                dataArray.unshift(['Registration', 'Percentage']);
                var data = google.visualization.arrayToDataTable(dataArray);
                var chartOptions = {
                    title: question_description,
                    pieSliceText: 'value',
                    is3D: true
                };

                var chart = new google.visualization.PieChart(document.getElementById(question_id));
                chart.draw(data, chartOptions);
            });
        }

    }

}

</script>

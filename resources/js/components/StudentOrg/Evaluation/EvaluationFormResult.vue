<template>
    <!-- <h6>1. PROGRAM/ACTIVITY</h6> -->
    <div class="d-flex justify-content-between p-2" >
        <div class="d-flex justify-content-start">
            <h3><i class="fas fa-list mt-2"></i> Evaluation</h3>
        </div>
        <div class="d-flex justify-content-end">

            <button id="print-button" class="btn me-2" @click="printSummary()">
                <i class="fas fa-print"></i>
                Print Results
            </button>
            <!-- <button class="btn me-2" id="download-results-button" @click="downloadPDF()">
    <i class="fas fa-download"></i> Download Results
</button>
            <a class="btn me-2" href="/student_organization_evaluation_results_table">
                <i class="fas fa-eye"></i> View Table
            </a> -->
        </div>
    </div>
    <div v-if="loading" class="row d-flex gap-2 mb-4" style="padding: 10px">
        <div>
            <span class="placeholder col-6"></span>
        <span class="placeholder w-75"></span>
        <span class="placeholder col-4"></span>
        <span class="placeholder col-4"></span>
        </div>


        <div
            class="card col-md-6"
            aria-hidden="true"
            style="height: 100%; border: none; padding: 20px"
        >
            <div class="row d-flex gap-4">
                <div class="col-md-4">
                    <span class="placeholder col-12 bg-secondary"></span>
                    <h3 class="card-title placeholder-glow mt-2">
                        <span
                            class="placeholder col-md-6 bg-secondary"
                            style="
                                height: 210px;
                                width: 230px;
                                border-radius: 50%;
                            "
                        ></span>
                    </h3>
                </div>
                <div class="col-md-6 details-load">
                    <p class="card-text placeholder-wave mt-2 text-start">
                        <br />
                        <span class="placeholder col-4 bg-secondary"></span>
                        <br />
                        <span
                            class="placeholder mt-4 col-4 bg-secondary"
                        ></span>
                        <br />
                        <span
                            class="placeholder col-4 bg-secondary mt-2"
                        ></span>
                        <br />
                        <span class="placeholder col-4 bg-secondary"></span>
                        <br />
                        <span class="placeholder col-4 bg-secondary"></span>
                    </p>
                </div>
            </div>
        </div>
        <div
            class="card col"
            aria-hidden="true"
            style="height: 100%; border: none; padding: 20px"
        >
            <div class="row d-flex gap-4">
                <div class="col-md-4">
                    <span class="placeholder col-12 bg-secondary"></span>
                    <h3 class="card-title placeholder-glow mt-2">
                        <span
                            class="placeholder col-md-6 bg-secondary"
                            style="
                                height: 210px;
                                width: 230px;
                                border-radius: 50%;
                            "
                        ></span>
                    </h3>
                </div>
                <div class="col-md-6 details-load">
                    <p class="card-text placeholder-wave mt-2 text-start">
                        <br />
                        <span class="placeholder col-4 bg-secondary"></span>
                        <br />
                        <span
                            class="placeholder mt-4 col-4 bg-secondary"
                        ></span>
                        <br />
                        <span
                            class="placeholder col-4 bg-secondary mt-2"
                        ></span>
                        <br />
                        <span class="placeholder col-4 bg-secondary"></span>
                        <br />
                        <span class="placeholder col-4 bg-secondary"></span>
                    </p>
                </div>
            </div>
        </div>
        <div
            class="card col-md-6"
            aria-hidden="true"
            style="height: 100%; border: none; padding: 20px"
        >
            <div class="row d-flex gap-4">
                <div class="col-md-4">
                    <span class="placeholder col-12 bg-secondary"></span>
                    <h3 class="card-title placeholder-glow mt-2">
                        <span
                            class="placeholder col-md-6 bg-secondary"
                            style="
                                height: 210px;
                                width: 230px;
                                border-radius: 50%;
                            "
                        ></span>
                    </h3>
                </div>
                <div class="col-md-6 details-load">
                    <p class="card-text placeholder-wave mt-2 text-start">
                        <br />
                        <span class="placeholder col-4 bg-secondary"></span>
                        <br />
                        <span
                            class="placeholder mt-4 col-4 bg-secondary"
                        ></span>
                        <br />
                        <span
                            class="placeholder col-4 bg-secondary mt-2"
                        ></span>
                        <br />
                        <span class="placeholder col-4 bg-secondary"></span>
                        <br />
                        <span class="placeholder col-4 bg-secondary"></span>
                    </p>
                </div>
            </div>
        </div>
        <div
            class="card col"
            aria-hidden="true"
            style="height: 100%; border: none; padding: 20px"
        >
            <div class="row d-flex gap-4">
                <div class="col-md-4">
                    <span class="placeholder col-12 bg-secondary"></span>
                    <h3 class="card-title placeholder-glow mt-2">
                        <span
                            class="placeholder col-md-6 bg-secondary"
                            style="
                                height: 210px;
                                width: 230px;
                                border-radius: 50%;
                            "
                        ></span>
                    </h3>
                </div>
                <div class="col-md-6 details-load">
                    <p class="card-text placeholder-wave mt-2 text-start">
                        <br />
                        <span class="placeholder col-4 bg-secondary"></span>
                        <br />
                        <span
                            class="placeholder mt-4 col-4 bg-secondary"
                        ></span>
                        <br />
                        <span
                            class="placeholder col-4 bg-secondary mt-2"
                        ></span>
                        <br />
                        <span class="placeholder col-4 bg-secondary"></span>
                        <br />
                        <span class="placeholder col-4 bg-secondary"></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div v-else class="mt-2" id="evaluation-summary">
        <h5>Student Organizations Evaluation Form</h5>
        <hr />
        <p class="mb-0" for="Activity">
            Event: <b>{{ this.event_description.event_name }}</b>
        </p>
        <p class="mb-0" for="StudentOrganization">
            Name of Organization: <b>{{ this.event_description.org_name }}</b>
        </p>
        <p class="mb-0" for="DateTime">
            Date: <b>{{ this.event_description.date }}</b>
        </p>
        <p class="mb-0" for="Venue">
            Venue: <b>{{ this.event_description.venue }}</b>
        </p>
        <p class="mb-0" for="Venue">
            Total Responses: <b>{{ this.event_description.totalResponse }}</b>
        </p>

        <div class="row">
            <div
                class="col-md-6 mb-4"
                v-for="evaluation_questions in evaluation_question_id"
            >
                <div class="piechart" :id="evaluation_questions.id"></div>
            </div>
        </div>

        <div class="col-md-12 mt-4 col-12 feedback">
            <h4>Feedbacks</h4>
            <div class="feedbacklist-card">
                <ul class="list-group" id="evaluation-feedbacks">
                    <li
                        class="list-group-item mb-2"
                        v-for="feedbacks in this.feedback"
                    >
                        {{ feedbacks.word_answer }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import jsPDF from "jspdf";
import html2canvas from "html2canvas";

import { convertDate } from "../Functions/DateConverter.js";
export default {
    props: ["event_id"],
    data() {
        return {
            loading: true,
            evaluation_result: [],
            evaluation_question_id: [],
            feedback: [],
            event_description: {
                event_name: "",
                org_name: "",
                date: "",
                venue: "",
                totalResponse: "",
            },
        };
    },
    mounted() {
        this.fetchEvent();
        this.fetchTotaResponse();
        console.log("mounted");
        // this.pieChart();
        this.fetchAnswer();
        this.fetchFeedback();
    },
    methods: {
        async fetchTotaResponse() {
            await axios
                .get(`/getTotalResponse/${this.event_id}`)
                .then((response) => {
                    console.log(response.data);
                    this.event_description.totalResponse = response.data;
                })
                .catch((error) => {
                    // Handle error
                    console.log(error);
                });
        },

        fetchFeedback() {
            axios
                .get(`/get_evaluation_feedback/${this.event_id}`)
                .then((response) => {
                    console.log(response.data);
                    this.feedback = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        fetchEvent() {
            axios
                .get(`/get_events/${this.event_id}`)
                .then((response) => {
                    console.log(response.data);
                    this.event_description.event_name = response.data.name;
                    this.event_description.org_name =
                        response.data.organization.name;
                    this.event_description.date = convertDate(
                        response.data.start_date
                    );
                    this.event_description.venue = response.data.location;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        fetchAnswer() {
            this.loading = true;
            axios
                .get(`/evaluation_answer/${this.event_id}`)
                .then((response) => {
                    this.loading = false;
                    console.log(response.data);
                    this.evaluation_result = response.data;
                    this.evaluation_result.forEach((evaluation) => {
                        evaluation.evaluation_question.forEach((question) => {
                            this.evaluation_question_id.push({
                                id: question.id,
                            });
                            // console.log(question);
                            let options = [];
                            let answers_temporary = [];
                            question.evaluation_option.forEach((option) => {
                                options.push({
                                    option_id: option.id,
                                    option: option.option,
                                });
                            });
                            question.evaluation_answers.forEach((element) => {
                                answers_temporary.push({
                                    answers_option_id: element.option_id,
                                });
                            });
                            //to count the result per options
                            let combinedData =
                                options.concat(answers_temporary);
                            let counts = {};

                            combinedData.forEach((item) => {
                                if (item.option_id !== undefined) {
                                    5;
                                    if (!counts[item.option_id]) {
                                        counts[item.option_id] = 0;
                                    }
                                } else {
                                    // It's an answers_temporary item
                                    // Ensure counts[item.answers_option_id] is initialized before incrementing
                                    if (!counts[item.answers_option_id]) {
                                        counts[item.answers_option_id] = 0;
                                    }
                                    counts[item.answers_option_id]++;
                                }
                            });

                            // Convert counts object to an array of objects
                            let answers = Object.entries(counts).map(
                                ([option_id, count]) => ({ option_id, count })
                            );
                            this.$nextTick(() => {
                                this.pieChart(
                                    question.id,
                                    question.description,
                                    options,
                                    answers
                                );
                            });
                        });
                    });
                })
                .catch((error) => {
                    this.loading = false;
                    console.log(error);
                });
        },
        pieChart(
            question_id,
            question_description,
            question_options,
            question_answers
        ) {
            // console.log('')
            // console.log(question_options)
            // console.log(question_id)
            google.charts.load("current", { packages: ["corechart"] });

            google.charts.setOnLoadCallback(() => {
                // Define the data array
                var dataArray = [];

                // Populate the data array with your dynamic data
                var options = question_options;
                var percentage = question_answers;
                // console.log(percentage)
                // Create a mapping between option_id and count from the percentage object
                var percentageMap = {};
                question_answers.forEach((item) => {
                    percentageMap[item.option_id] = item.count;
                });

                // Populate the data array with dynamic data based on options and percentageMap
                question_options.forEach((option) => {
                    var count = percentageMap[option.option_id] || 0; // Default to 0 if option_id not found
                    dataArray.push([option.option, count]);
                });
                dataArray.unshift(["Registration", "Percentage"]);
                var data = google.visualization.arrayToDataTable(dataArray);
                var chartOptions = {
                    width: 600,
                    height: 340,
                    title: question_description,
                    titleTextStyle: {
                        fontSize: 15,
                    },
                    pieSliceText: "value",
                    is3D: true,
                };

                var chart = new google.visualization.PieChart(
                    document.getElementById(question_id)
                );
                chart.draw(data, chartOptions);
            });
        },
        printSummary() {
            const contentToPrint = document
                .getElementById("evaluation-summary")
                .cloneNode(true);

            // Create a hidden iframe for printing
            const iframe = document.createElement("iframe");
            iframe.style.display = "none";
            document.body.appendChild(iframe);
            const iframeDoc = iframe.contentWindow.document;
            iframeDoc.open();
            iframeDoc.write(`
    <!DOCTYPE html>
<html><head><title>Evaluation  Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

<body>
    ${contentToPrint.innerHTML}
    </body>
</html>

`);
            iframeDoc.close();

            // Print the iframe content
            iframe.contentWindow.focus();
            iframe.contentWindow.print();

            // Remove the iframe after printing
            setTimeout(() => {
                document.body.removeChild(iframe);
            }, 1000);
        },
    },
};
</script>

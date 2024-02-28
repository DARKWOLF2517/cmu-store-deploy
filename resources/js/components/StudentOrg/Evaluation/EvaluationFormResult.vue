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
        <h6 for="Activity">Event: <b>bIRTHDAU</b> </h6>
        <h6 for="StudentOrganization">Name of Organization: <b>dwdeef</b></h6>
        <h6 for="DateTime">Date & Time: <b>efefefef</b></h6>
        <h6 for="Venue">Venue: <b>effefe</b></h6>
        <div class="row">
            <div class="col" v-for="evaluation_questions in evaluation_question_id">
                <div class="piechart" :id="evaluation_questions.id"></div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['event_id'],
    data() {
        return {
            evaluation_result: [],
            evaluation_question_id: [],
        }
    },
    mounted() {
        console.log('mounted')
        // this.pieChart();
        this.fetchAnswer();
    },
    methods: {
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
                                if (item.option_id !== undefined) {5
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

                            // console.log(counts);

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
        // pieChart(question_id, question_desription) {
        //     google.charts.load('current', { 'packages': ['corechart'] });
        //     google.charts.setOnLoadCallback(display_chart(question_id, question_desription));
        //     function display_chart(question_id, question_desription) {
        //         var data = google.visualization.arrayToDataTable([

        //             ['Registration', 'Percentage'],
        //             ['Outstanding', 10],
        //             ['Very Satisfactory', 10],
        //             ['Satisfactory', 10],
        //             ['Moderately Satisfactory', 10],
        //             ['Needs Improvement', 10],
        //         ]);

        //         var options = {
        //             title: question_desription,
        //             pieSliceText: 'value',
        //             is3D: true
        //         };
        //         var chart = new google.visualization.PieChart(document.getElementById(question_id));
        //         chart.draw(data, options);
        //     }




        // },
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

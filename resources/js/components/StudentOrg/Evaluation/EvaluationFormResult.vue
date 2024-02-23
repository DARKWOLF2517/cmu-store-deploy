<template>
    <h6>1. PROGRAM/ACTIVITY</h6>
    <div class="row">
        <div class="col">
            <div class="piechart" :id="this.event_id"></div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['event_id'],
    data() {
        return {

        }
    },
    mounted() {
        console.log('mounted')
        this.pieChart();
        this.fetchAnswer();
    },
    methods: {
        fetchAnswer() {
            axios.get(`/evaluation_answer/${this.event_id}`)
                .then(response => {
                    console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                });
        },
        pieChart() {
            google.charts.load('current', { 'packages': ['corechart'] });

            //question1
            google.charts.setOnLoadCallback(display_chart(this.event_id));
            function display_chart(id) {
                var data = google.visualization.arrayToDataTable([

                    ['Registration', 'Percentage'],
                    ['Outstanding', 10],
                    ['Very Satisfactory', 10],
                    ['Satisfactory', 10],
                    ['Moderately Satisfactory', 10],
                    ['Needs Improvement', 10],
                ]);

                var options = {
                    title: 'Stimulates the interest of the students.',
                    pieSliceText: 'value',
                    is3D: true
                };
                var chart = new google.visualization.PieChart(document.getElementById(id));
                chart.draw(data, options);
            }




        },
    }

}

</script>
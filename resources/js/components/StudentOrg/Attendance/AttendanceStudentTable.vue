<template>


<div class="mt-2">
            <div class="row head-container">
                <div class="col-md-6 col-sm-12">
                    <div class="input-container">
                        <i class="fa fa-search"></i>
                        <input type="text" placeholder="Search Event">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end;">
                    <!-- <button class="btn sort-btn"><i class="bi bi-sort-up"></i></button> -->
                    <div class="select-dropdown">
                        <select id="sort-select" class="form-control" style="text-align: center;">
                            <option value="">Select Semester</option>
                            <option value="option1">1st Semester 2023-2024</option>
                            <option value="option2">2nd Semester 2022-2023</option>
                            <option value="option3">1st Semester 2022-2023</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
            <h4> <i class="fas fa-list mt-2"></i> Attendance Record</h4>
            <div class="container" id="table-container">
                <div class=" student-buttons d-flex justify-content-end">
                    <div class="btn-group" role="group">
                        <button class="btn me-2" id="add-student-list-button">
                            <i class="fas fa-print"></i> Print Recorded Attendance
                        </button>
                        <button class="btn me-2" id="add-student-button">
                            <i class="fas fa-download"></i> Download Recorded Attendance
                        </button>
                    </div>
                </div>
                <div class="scroll-pane">
            <h5 id="Eventtitle"> Event: <b>{{ this.event.event_title }}</b></h5>
            <p>Date: <b>{{ this.event.event_date }}</b> </p>
            <table  id="accountabilities-table">
                <thead>
                    <tr>
                        <th class="sortable-header">Student ID</th>
                        <th class="sortable-header">Student Name</th>
                        <th class="sortable-header">Session</th>
                        <th class="sortable-header">Actions</th>
                    </tr>
                </thead>
                <tbody v-for="attendance in this.attendance" :id="attendance.user_id">
                    <tr>
                        <td>{{ attendance['user_id'] }}</td>
                        <td>{{ attendance['user']['name'] }}</td>
                        <td>In</td>
                        <td>
                            <button class="edit-button ellipsis-button" >
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="delete-button ellipsis-button">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
            <div class="pagination">
                <button id="first-page-button" onclick="goToPage(1)" disabled>&lt;&lt;</button>
                <button id="previous-page-button" onclick="previousPage()" disabled>&lt; Previous</button>
                <span id="pagination-numbers"></span>
                <button id="next-page-button" onclick="nextPage()">Next &gt;</button>
                <button id="last-page-button" onclick="goToPage(pageCount)">&gt;&gt;</button>
            </div>
        </div>

</template>

<script>
import {converTime} from "../Functions/TimeConverter.js";
export default{
    props:['organization_id', 'event_id'],
    data(){
        return{
            attendance: [],
            event: {
                event_title : '',
                event_date: '',
            },
        }
    },
    mounted() {
        console.log('mounted')
        this.fetchData();
    },
    methods:{
        fetchData(){
        axios.get(`/attendance/list/${this.organization_id}/${this.event_id}`)
            .then(response => {


                const data = response.data;
                    data.forEach(item => {
                        // console.log(item);
                        item['events']['start_attendance'] = converTime(item['events']['start_attendance']);
                        this.event.event_title = item['events']['name'];
                        this.event.event_date = item['events']['start_attendance'];
                    });
                    this.attendance = response.data;
            })
            .catch(error => {

            });
    },

    },
}

</script>

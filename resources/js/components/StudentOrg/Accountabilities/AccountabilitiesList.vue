<template>      

<div class="container" id="table-container">
        <div class="student-buttons d-flex justify-content-end">
            <div class="btn-group" role="group">
                <button class="btn me-2" id="add-student-list-button" onclick="printTableData()">
                    <i class="fas fa-print"></i> Print
                </button>
                <button class="btn me-2" id="add-student-button" onclick="  downloadTableData()">
                    <i class="fas fa-download"></i> Download
                </button>
            </div>
        </div>
            <div class="scroll-pane">
            <table  id="accountabilities-table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Accountabilities</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>2023-05-01</td>
                    <td>John Smith</td>
                    <td>College Fee</td>
                    <td>Php 1000</td>
                    <td>
                        <button class="edit-button ellipsis-button" onclick="editStudent(this)"><i class="bi bi-pencil-square"></i></button>
                        <button class="delete-button ellipsis-button"><i class="bi bi-trash"></i></button>
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
                <div id="edit-modal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="event-modal-label">Edit Student Membership fee</h5>
                        </div>
                    </div>
                </div>
</div>

</template>

<script>
import { convertDate } from '../Functions/DateConverter';

export default{
    props: ['org_id'],
    data(){
        return{
            attendance_list: [],
            event_with_session: [],
            absentStudents: [],
        }
    },
    mounted(){
        console.log('mounted');
        this.fetchData();
        console.log(this.getAbsentStudents())
    },

    methods:{

        fetchData(){
            axios.get(`/accountabilities_list/${this.org_id}`)
                    .then(response => {
                        const events_with_attendance = response.data.accountabilities;
                        const users = response.data.user;


                        events_with_attendance.forEach(data => {
                        const user_attendance = data.attendance;
                            const events = {
                                event_id : data.event_id,
                                session_count : data.attendance_count,
                            }
                            user_attendance.forEach(attend => {
                                    const attendanceRecord = {
                                        user_id: attend.user_id,
                                        session: attend.session,
                                        event_id: attend.event_id,
                                    };
                                this.attendance_list.push(attendanceRecord);
                                
                            });

                            this.event_with_session.push(events);
                        });




                    })
                    .catch(error => {
                        console.log(error)

                }); 
        },
        getAbsentStudents() {
            let absentStudents = [];

            // Iterate through attendance_list
            this.attendance_list.forEach(student => {
                // Check if the student's session exists in event_with_session
                const event = this.event_with_session.find(
                event => event.event_id === student.event_id
                );

                // If event and session count exist but student's session is absent
                if (event && event.session_count >= student.session) {
                const sessionExists = this.attendance_list.some(
                    item =>
                    item.user_id === student.user_id &&
                    item.session === student.session
                );

                if (!sessionExists) {
                    absentStudents.push({
                    user_id: student.user_id,
                    session: student.session
                    });
                }
                }
            });

            return absentStudents;
            }

    }


}

</script>
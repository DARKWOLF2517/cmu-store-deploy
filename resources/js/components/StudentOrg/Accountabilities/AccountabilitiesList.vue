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
            events: [],
            attendance: [],
        }
    },
    mounted(){
        // console.log('asdfd')
        this.fetchData();
        // console.log(this.getAbsentStudents())
    },

    methods:{

        fetchData(){
            axios.get(`/accountabilities_list/${this.org_id}`)
                    .then(response => {

                        const events_with_attendance = response.data.accountabilities;
                        // const users = response.data.user;
                        events_with_attendance.forEach(attend=> {
                            if (attend.attendance_count == 1){
                                for (let index = 1; index <= 1; index++) {
                                    const session_count = {
                                    event_id: attend.event_id,
                                    session: index

                                    
                                }
                                this.events.push(session_count);
                            }
                            }
                            else if (attend.attendance_count == 2) {
                                for (let index = 1; index <= 2; index++) {
                                    const session_count = {
                                    event_id: attend.event_id,
                                    session: index
                                    
                                }
                                this.events.push(session_count);
                                
                            }
                            }
                            else if (attend.attendance_count == 3) {
                                for (let index = 1; index <= 3; index++) {
                                    const session_count = {
                                    event_id: attend.event_id,
                                    session: index
                                    
                                }
                                this.events.push(session_count); 
                            }
                            }
                            else if (attend.attendance_count == 4) {
                                for (let index = 1; index <= 4; index++) {
                                    const session_count = {
                                    event_id: attend.event_id,
                                    session: index
                                    
                                }
                                this.events.push(session_count); 
                            }
                            }
                            


                            const attendance = attend.attendance;
                                attendance.forEach(data=> {
                                    // console.log(data)
                                    const attendance = {
                                        event_id: data.event_id,
                                        user_id : data.user_id,
                                        session: data.session,
                                    }
                                    // console.log(attendance);
                                    this.attendance.push(attendance);
                                    
                                })

                            
                        })
                        // console.log(this.events)
                        // console.log(this.attendance)

const events = [
  { event_id: 5, session: 1 },
  { event_id: 5, session: 2 },
  { event_id: 21, session: 1 },
  { event_id: 21, session: 2 }
];

const attendance = [
  { event_id: 5, user_id: 2020301072, session: 1 },
  { event_id: 5, user_id: 2020301072, session: 2 }
];

const users = [
  { user: 'Jerricho', user_id: 2020301072 },
  { user: 'Alphalyn', user_id: 2020300620 }
];

const userSessionsPresent = attendance.reduce((acc, entry) => {
  if (!acc[entry.user_id]) {
    acc[entry.user_id] = {};
  }
  if (!acc[entry.user_id][entry.event_id]) {
    acc[entry.user_id][entry.event_id] = new Set();
  }
  acc[entry.user_id][entry.event_id].add(entry.session);
  return acc;
}, {});

const missingSessions = [];

users.forEach(user => {
  events.forEach(event => {
    if (!userSessionsPresent[user.user_id] || !userSessionsPresent[user.user_id][event.event_id]) {
      missingSessions.push({
        user_id: user.user_id,
        event_id: event.event_id,
        missing_session: event.session
      });
    } else if (!userSessionsPresent[user.user_id][event.event_id].has(event.session)) {
      missingSessions.push({
        user_id: user.user_id,
        event_id: event.event_id,
        missing_session: event.session
      });
    }
  });
});

console.log("Missing sessions:", missingSessions);

                    })
                    .catch(error => {
                        console.log(error)

                }); 
                // console.log(this.event_with_session)
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
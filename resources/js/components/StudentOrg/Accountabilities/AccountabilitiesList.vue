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
                <tbody v-for="fines_list in this.fines_list" :id="fines_list.event_id" >
                    <tr>
                    <td >{{ fines_list.user_id }}</td>
                    <td> {{ fines_list.name }}</td>
                    <td>{{ fines_list.accountability_type.toUpperCase()}}</td>
                    <td>{{ fines_list.total_fines }}</td>
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
            overall_fines_list:[],
            fines_list:[],
            
        }
    },
    mounted(){
        // console.log('asdfd')
        // this.fetchData();
        // console.log(this.getoverall_fines_listStudents())
    },
    created(){
        this.fetchData();
    },

    methods:{

        fetchData(){
            axios.get(`/accountabilities_list/${this.org_id}`)
                    .then(response => {

                        const events_with_attendance = response.data.accountabilities;
                        const users = response.data.user;
                        events_with_attendance.forEach(attend=> {
                            if (attend.attendance_count == 1){
                                for (let index = 1; index <= 1; index++) {
                                    const session_count = {
                                    event_id: attend.event_id,
                                    session: index,
                                    fines: attend.fines,

                                    
                                }
                                this.events.push(session_count);
                            }
                            }
                            else if (attend.attendance_count == 2) {
                                for (let index = 1; index <= 2; index++) {
                                    const session_count = {
                                    event_id: attend.event_id,
                                    session: index,
                                    fines: attend.fines,
                                    
                                }
                                this.events.push(session_count);
                                
                            }
                            }
                            else if (attend.attendance_count == 3) {
                                for (let index = 1; index <= 3; index++) {
                                    const session_count = {
                                    event_id: attend.event_id,
                                    session: index,
                                    fines: attend.fines,
                                    
                                }
                                this.events.push(session_count); 
                            }
                            }
                            else if (attend.attendance_count == 4) {
                                for (let index = 1; index <= 4; index++) {
                                    const session_count = {
                                    event_id: attend.event_id,
                                    session: index,
                                    fines: attend.fines,
                                    
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

                        const userSessionsPresent = this.attendance.reduce((acc, entry) => {
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
                        this.events.forEach(event => {
                            if (!userSessionsPresent[user.id] || !userSessionsPresent[user.id][event.event_id]) {
                            missingSessions.push({
                                name: user.name,
                                user_id: user.id,
                                event_id: event.event_id,
                                amount: event.fines,
                                missing_session: event.session,
                                accountability_type: 'fines'
                            });
                            } else if (!userSessionsPresent[user.id][event.event_id].has(event.session)) {
                            missingSessions.push({
                                name: user.name,
                                user_id: user.id,
                                event_id: event.event_id,
                                amount: event.fines,
                                missing_session: event.session,
                                accountability_type: 'fines'
                            });
                            }
                        });
                        });

                        // console.log("Missing sessions:", missingSessions);
                        missingSessions.forEach(overall_fines_list=>{
                                const missing = {
                                name: overall_fines_list.name,
                                user_id: overall_fines_list.user_id,
                                event_id: overall_fines_list.event_id,
                                amount: overall_fines_list.amount,
                                missing_session: overall_fines_list.missing_session,
                                accountability_type: overall_fines_list.accountability_type
                            }
                            this.overall_fines_list.push(missing);
                        })
                        
                        // Function to aggregate data by user ID
                        const aggregateData = (dataArray) => {
                        const aggregated = {};

                        // Loop through the array and aggregate data by user ID
                        dataArray.forEach((item) => {
                            const { user_id, name, event_id, amount, missing_session, accountability_type } = item;

                            // Check if the user ID already exists in the aggregated data
                            if (!aggregated[user_id]) {
                            // If it doesn't exist, create a new entry
                            aggregated[user_id] = {
                                name,
                                user_id,
                                event_id,
                                missing_session,
                                accountability_type,
                                total_amount: amount, // Initialize total amount for the user ID
                            };
                            } else {
                            // If it exists, update the total amount by merging with the existing amount
                            aggregated[user_id].total_amount += amount;
                            aggregated[user_id].amount += amount; // Merge total_amount with amount
                            }
                        });

                        // Convert aggregated object to an array of objects
                        const aggregatedArray = Object.values(aggregated);
                        return aggregatedArray;
                        };

                        // Call the function with your data array
                        const aggregatedDataArray = aggregateData(this.overall_fines_list);
                        aggregatedDataArray.forEach(aggregated=>{
                            this.fines_list.push({
                                name: aggregated.name,
                                user_id: aggregated.user_id,
                                event_id: aggregated.event_id,
                                total_fines: aggregated.total_amount,
                                missing_session: aggregated.missing_session,
                                accountability_type: aggregated.accountability_type
                            })
                        })

                        console.log(this.fines_list)
                        console.log(this.overall_fines_list)

                    })
                    .catch(error => {
                        console.log(error)

                }); 
                // console.log(this.event_with_session)
        },

    }


}

</script>
<template>

<div class="col-md-4 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end; margin-right: 20px;">
                    <div class="select-dropdown">
                        <!-- First dropdown -->
                        <select id="sort-select" class="form-control" style="text-align: center;" v-model="this.select_accountability">
                            <option value="" disabled selected><i class="fas fa-filter"></i> Sort by</option>
                            <option value="fines">Fines</option>
                            <option value="membership_fee">Membership Fee</option>
                        </select>
                    </div>

                    <!-- {{-- <button class="btn sort-btn"><i class="fas fa-filter"></i></button> --}} -->

                    <div class="select-dropdown" id= "semester-btn" style="margin-left: 20px; width: 270px;">
                        <!-- Second dropdown -->
                        <select id="sort-select" class="form-control" style="text-align: center; ">
                            <option value="">Select Semester</option>
                            <option value="option1">1st Semester 2023-2024</option>
                            <option value="option2">2nd Semester 2022-2023</option>
                            <option value="option3">1st Semester 2022-2023</option>
                        </select>
                    </div>
                </div>


    <h4> <i class="fas fa-list mt-2"></i>  Student Accountabilities</h4>

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
                <table  id="accountabilities-table" v-if="this.select_accountability === 'fines' ">
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
                            <button class="view-button btn" data-bs-toggle="modal" data-bs-target="#viewAllAccountabilitiesModal" @click="this.viewAccountabilities(fines_list.user_id)">
                            <i class="bi bi-eye"></i> View
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
                <div id="edit-modal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="event-modal-label">Edit Student Membership fee</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- View Modal -->
            <div class="modal fade" id="viewAllAccountabilitiesModal" tabindex="-1" aria-labelledby="viewAllAccountabilitiesModalLabel" aria-hidden="true" v-i>
                <div class="modal-dialog  modal-dialog-centered modal-lg "  style="max-width: 80%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewAllAccountabilitiesModalLabel">View Student Accountability</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table" v-for="temporary_fines_list in this.temporary_fines_list" :id="temporary_fines_list.event_id">
                            <thead>
                                <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Accountabilities</th>
                                <th>event</th>
                                <th>Missing Session</th>
                                <th>Date</th>
                                <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>{{temporary_fines_list.user_id }}</td>
                                <td>{{temporary_fines_list.name }}</td>
                                <td>{{temporary_fines_list.accountability_type.toUpperCase() }}</td>
                                <td>{{temporary_fines_list.event_id }}</td>
                                <div>
                                    <td v-if="temporary_fines_list.missing_session === 1">Morning (in)</td>
                                    <td v-else-if="temporary_fines_list.missing_session === 2">Morning (out)</td>
                                    <td v-else-if="temporary_fines_list.missing_session === 3">Afternoon (in)</td>
                                    <td v-else-if="temporary_fines_list.missing_session === 4">Afternoon (out)</td>
                                </div>
                                <td>{{temporary_fines_list.date }} </td>
                                <td>{{temporary_fines_list.amount }} </td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmationModal">Paid</button>
                        </div>
                    </div>
            </div>
            </div>
            <!-- Confirmation Modal -->
            <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmationModalLabel">Confirm Payment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to mark this as paid?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#viewAllAccountabilitiesModal">Yes, Mark as Paid</button>
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
            temporary_fines_list:[],
            select_accountability: 'fines',

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
        viewAccountabilities(user_id){
            this.temporary_fines_list= [];
            this.overall_fines_list.forEach(fines=>{
                if (fines.user_id == user_id){
                    this.temporary_fines_list.push({
                        name: fines.name,
                        user_id: fines.user_id,
                        event_id: fines.event_id,
                        amount: fines.amount,
                        missing_session: fines.missing_session,
                        accountability_type: fines.accountability_type,
                        date: fines.date,
                    });
                }
            })
            console.log(this.temporary_fines_list)
        },

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
                                    date: attend.start_date,


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
                                    date: attend.start_date,

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
                                    date: attend.start_date,

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
                                    date: attend.start_date,

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
                                    accountability_type: 'fines',
                                    date: event.date,
                                });
                                } else if (!userSessionsPresent[user.id][event.event_id].has(event.session)) {
                                missingSessions.push({
                                    name: user.name,
                                    user_id: user.id,
                                    event_id: event.event_id,
                                    amount: event.fines,
                                    missing_session: event.session,
                                    accountability_type: 'fines',
                                    date: event.date,
                                });
                                }
                            });
                        });


                        // console.log("Missing sessions:", missingSessions);
                        missingSessions.forEach(overall_fines_list=>{
                                events_with_attendance.forEach(event_name=>{
                                    if(overall_fines_list.event_id === event_name.event_id){
                                        const missing = {
                                            name: overall_fines_list.name,
                                            user_id: overall_fines_list.user_id,
                                            event_id: event_name.name,
                                            amount: overall_fines_list.amount,
                                            missing_session: overall_fines_list.missing_session,
                                            accountability_type: overall_fines_list.accountability_type,
                                            date: overall_fines_list.date
                                        }
                                        this.overall_fines_list.push(missing);
                                    }
                                })
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

                        // console.log(this.fines_list)
                        // console.log(this.overall_fines_list)

                    })
                    .catch(error => {
                        console.log(error)

                });
                // console.log(this.event_with_session)
        },

    }


}

</script>

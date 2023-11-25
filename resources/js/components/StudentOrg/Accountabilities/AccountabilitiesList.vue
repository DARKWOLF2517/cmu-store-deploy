<template>
                <div class="col-md-6 col-sm-12">
                    <div class="input-container">
                        <i class="fa fa-search"></i>
                        <input type="text" v-model="searchTerm"   @input="filterItems" placeholder="Search Accountabilities" >
                    </div>
                </div>
                <div class="col-md-4 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end; margin-right: 20px;">
                    <div class="select-dropdown">
                        <!-- First dropdown -->
                        <select id="sort-select" class="form-control" style="text-align: center;" v-model="this.select_accountability">
                            <option value="" disabled selected><i class="fas fa-filter"></i> Sort by</option>
                            <option value="fines">Fines</option>
                            <option value="others">Other Accountability</option>
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
                <!-- fines accountabilities -->
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
                    <tbody v-for="fines_list in this.filtered_items_for_fines" :id="fines_list.user_id" >
                        <tr>
                        <td >{{ fines_list.user_id }}</td>
                        <td> {{ fines_list.name }}</td>
                        <td>{{ fines_list.accountability_type.toUpperCase()}}</td>
                        <td>{{ fines_list.total_fines }}</td>
                        <td>
                            <button class="view-button btn" data-bs-toggle="modal" data-bs-target="#viewAllAccountabilitiesModal" @click="this.viewAccountabilities(fines_list.user_id)">
                            <i class="bi bi-eye"></i> See More
                            </button>
                        </td>
                        </tr>
                    </tbody>
                </table>
                <!-- other accountabilities -->
                <table  id="accountabilities-table" v-if="this.select_accountability === 'others' ">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Accountabilities</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody v-for="fines_list in this.filtered_items_for_other_accountabilities" :id="fines_list.user_id" >
                        <tr>
                        <td >{{ fines_list.user_id }}</td>
                        <td> {{ fines_list.name }}</td>
                        <td>{{ fines_list.accountability_type.toUpperCase()}}</td>
                        <td>{{ fines_list.amount }}</td>
                        <td>
                            <button class="view-button btn" data-bs-toggle="modal" data-bs-target="#viewAllAccountabilitiesModal" @click="">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmationModal">Paid</button>
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
            <div class="modal fade" id="viewAllAccountabilitiesModal" tabindex="-1" aria-labelledby="viewAllAccountabilitiesModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered modal-lg "  style="max-width: 80%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewAllAccountabilitiesModalLabel">View Student Accountability</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
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
                                <tr  v-for="temporary_list in this.temporary_list" :id="temporary_list.event_id">
                                <td>{{temporary_list.user_id }}</td>
                                <td>{{temporary_list.name }}</td>
                                <td>{{temporary_list.accountability_type.toUpperCase() }}</td>
                                <td>{{temporary_list.event_id }}</td>
                                
                                <td v-if="temporary_list.missing_session === 1">Morning (in)</td>
                                <td v-else-if="temporary_list.missing_session === 2">Morning (out)</td>
                                <td v-else-if="temporary_list.missing_session === 3">Afternoon (in)</td>
                                <td v-else-if="temporary_list.missing_session === 4">Afternoon (out)</td>
    
                                <td>{{temporary_list.date }} </td>
                                <td>{{temporary_list.amount }} </td>
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
            other_accountabilities_list: [],
            temporary_list:[],
            select_accountability: 'fines',
            searchTerm: '',
            filtered_items_for_fines: [],
            filtered_items_for_other_accountabilities: [],


        }
    },

    mounted(){
        this.filtered_items_for_fines = this.fines_list;
        this.filtered_items_for_other_accountabilities = this.other_accountabilities_list;
    },
    created(){
        this.fetchData();

    },

    methods:{
        filterItems() {
            //FILTER OF FINES
            this.filtered_items_for_fines = this.fines_list.filter(item => {
                return (
                    item.name.toLowerCase().includes(this.searchTerm.toLowerCase())||
                    item.user_id.toString().includes(this.searchTerm)
                );
            });
            //FILTER FOR OTHER ACCOUNTABILITIES
            this.filtered_items_for_other_accountabilities = this.other_accountabilities_list.filter(item => {
                return (
                    item.name.toLowerCase().includes(this.searchTerm.toLowerCase())||
                    item.user_id.toString().includes(this.searchTerm)
                );
            });
        },
        
        viewAccountabilities(user_id){
            this.temporary_list= [];
            this.overall_fines_list.forEach(fines=>{
                if (fines.user_id == user_id){
                    this.temporary_list.push({
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
            console.log(this.temporary_list)
        },


        fetchData(){
            axios.get(`/fines_list/${this.org_id}`)
                    .then(response => {

                        //FOR FINES LOGIC
                        const events_with_attendance = response.data.accountabilities_fines;
                        let users = response.data.user;
                        let user_orgs = response.data.user_orgs;
                        const year_level = response.data.year_level;
                        
                        const change_user_year_level = []
                        user_orgs.forEach(element => {

                            const findYear =  year_level.find(year => year.id === element.year_level_id)
                                if(findYear){
                                    change_user_year_level.push({
                                        student_org_id : element.student_org_id,
                                        student_id : element.student_id,
                                        role_id: element.role_id,
                                        year_level_id: findYear.year_level,
                                    })
                                }

                                
                        });
                        
                        //CHANGE THE YEAR LEVEL TO NAME INSTEAD OF ID
                        // user_orgs = change_user_year_level;

                    // Function to filter users belonging to student_org_id 2 WHICH IS THE STUDENTS ELIMINATING THE ADMINS
                    const usersInOrg = [];
                    user_orgs.forEach(userOrg => {
                    
                        if (userOrg.student_org_id === this.org_id && userOrg.role_id === 2 ) {

                        const userId = userOrg.student_id;
                        const foundUser = users.find(user => user.id === userId);
                            if (foundUser) {
                                const user = {
                                id: foundUser.id,
                                name: foundUser.name,
                                year_level: userOrg.year_level_id,
                                org_id: userOrg.student_org_id
                                };
                                usersInOrg.push(user);
                            }
                        }
                    });



                        //SET USERS THAT IS ONLY COVERED WITH THE ORGANIZATION
                            users = usersInOrg;

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
                                    const attendance = {
                                        event_id: data.event_id,
                                        user_id : data.user_id,
                                        session: data.session,
                                    }
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
                                if(user.year_level== 2 && event.event_id == 24){

                                }
                                else{
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
                                }

                            });
                        });
                        console.log(missingSessions)


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


                        //FOR OTHER ACCOUNTABILITIES LOGIC
                        const accountability_paid = response.data.paid_accountabilities;
                        const organization_accountability_set = response.data.accountabilities_other;
                        const studentsWhoPaid = new Set(accountability_paid.map(entry => entry.student_id));

                        // Get a Set of unique accountability types from organization_accountability_set
                        const accountabilityTypes = new Set(organization_accountability_set.map(entry => entry.accountability_name));

                        // Find students who have not paid for their accountabilities and replace accountability_type
                        const studentsNotPaid = users.reduce((acc, user) => {
                        if (!studentsWhoPaid.has(user.id)) {
                            // Push user details with an indication of not being paid and relevant accountability info
                            organization_accountability_set.forEach(entry => {
                            acc.push({
                                user_id: user.id,
                                name: user.name,
                                org_id: entry.org_id,
                                accountability_type: entry.accountability_name,
                                amount: entry.amount,
                            });
                            });
                        }
                        return acc;
                        }, []);

                    // Display students who have not paid for their accountabilities with replaced accountability_type
                    studentsNotPaid.forEach(items =>{
                        this.other_accountabilities_list.push({
                                name: items.name,
                                user_id: items.user_id,
                                amount: items.amount,
                                accountability_type: items.accountability_type
                            })
                    })

                    })
                    .catch(error => {
                        console.log(error)

                });
        },

    }


}

</script>

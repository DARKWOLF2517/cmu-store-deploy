<template>
                <div class="col-md-6 col-sm-12">
                    <div class="input-container">
                        <i class="fa fa-search"></i>
                        <input type="text" v-model="searchTerm"   @input="filterItems" placeholder="Search Accountabilities" >
                    </div>
                </div>
                <div class="col-md-6 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end; gap: 20px;">
                    <div class="select-dropdown" id= "semester-btn" style="margin-left: 20px; width: 60%;">
                        <!-- Firts dropdown -->
                        <select id="sort-select" class="form-control" style="text-align: center;" v-model="school_year_input"  @change="fetchData">
                                <option value="0" disabled selected>Select Semester</option>
                                <option v-for="school_year in this.school_year" :value="school_year['id']" >{{ school_year['school_year'] }}</option>
                            </select>
                    </div>
                    <div class="select-dropdown">
                        <!-- Second dropdown -->
                        <select id="sort-select" class="form-control" style="text-align: center;" v-model="this.select_accountability">
                            <option value="" disabled selected><i class="fas fa-filter"></i> Sort by</option>
                            <option value="fines">Fines</option>
                            <option value="others">Other Accountability</option>
                        </select>
                    </div>

                    <!-- {{-- <button class="btn sort-btn"><i class="fas fa-filter"></i></button> --}} -->


                </div>


                <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fas fa-list mt-2"></i> Student Accountabilities</h4>
        <div class="student-buttons d-flex">
            <div class="btn-group" role="group">
                <button class="btn me-2" id="add-student-list-button" @click="printTable">
                    <i class="fas fa-print"></i> Print
                </button>
                <button class="btn me-2" id="add-student-button" @click="downloadTable">
                    <i class="fas fa-download"></i> Download
                </button>
            </div>
        </div>
    </div>
</div>

<div id="table-container" style="margin-left: 10px;">
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
                            <button class="view-button btn" data-bs-toggle="modal" data-bs-target="#viewAllAccountabilitiesModal" @click="this.viewAccountabilities(fines_list.user_id),
                                this.finesPay = {
                                    student_id: fines_list.user_id,
                                    student_name: fines_list.name,
                                    accountability_name: fines_list.accountability_type,
                                    amount: fines_list.total_fines,
                                    student_org_id: this.org_id,
                                }
                            ">
                            <i class="fas fa-eye"></i> See More
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

                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmationModal" @click="this.PaymentDecision = 2,
                                this.otherAccountabilitiesPaymentDetails = {
                                    student_id: fines_list.user_id,
                                    student_name: fines_list.name,
                                    accountability_name: fines_list.accountability_type,
                                    amount: fines_list.amount,
                                    student_org_id: this.org_id,
                                }">
                                Mark As Paid</button>
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- <div class="pagination">
                <button id="first-page-button" onclick="goToPage(1)" disabled>&lt;&lt;</button>
                <button id="previous-page-button" onclick="previousPage()" disabled>&lt; Previous</button>
                <span id="pagination-numbers"></span>
                <button id="next-page-button" onclick="nextPage()">Next &gt;</button>
                <button id="last-page-button" onclick="goToPage(pageCount)">&gt;&gt;</button>
            </div> -->

            <div class="pagination-container mt-3">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">1 <span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </div>
        </div>
                <div id="edit-modal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="event-modal-label">Edit Student Membership fee</h5>
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
                            <table class="table" id="temporaryList">
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
                                <td>{{temporary_list.event_name }}</td>

                                <td v-if="temporary_list.missing_session === 1">Morning (in)</td>
                                <td v-else-if="temporary_list.missing_session === 2">Morning (out)</td>
                                <td v-else-if="temporary_list.missing_session === 3">Afternoon (in)</td>
                                <td v-else-if="temporary_list.missing_session === 4">Afternoon (out)</td>
                                <td style="display: none;">{{ temporary_list.missing_session }}</td>
                                <td style="display: none;">{{ temporary_list.event_id }}</td>
                                <td style="display: none;">{{ this.org_id }}</td>
                                <td style="display: none;">{{ this.user_id }}</td>
                                <td>{{temporary_list.date }} </td>
                                <td>{{temporary_list.amount }} </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmationModal" @click="this.PaymentDecision = 1, this.getTableData1()">Mark As Paid</button>
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
                            <button v-if="this.PaymentDecision == 2" type="button" class="btn btn-success" data-bs-dismiss="modal"  @click="OtherAccountabilityPayment()">Yes, Mark as Paid</button>
                            <button v-else-if="this.PaymentDecision == 1" type="button" class="btn btn-success" data-bs-dismiss="modal"  @click="FinesPayment()">Yes, Mark as Paid</button>
                        </div>
                    </div>
                </div>
            </div>

</template>

<script>
import { convertDate } from '../Functions/DateConverter';
// import { toast } from 'vue3-toastify';
// import 'vue3-toastify/dist/index.css';
import * as XLSX from 'xlsx';

export default{
    props: ['org_id', 'user_id','school_year_session'],
    data(){
        return{
            events: [],
            attendance: [],
            overall_fines_list:[],
            overall_fines_list_with_event_id:[],
            fines_list:[],
            other_accountabilities_list: [],
            temporary_list:[],
            select_accountability: 'fines',
            searchTerm: '',
            filtered_items_for_fines: [],
            filtered_items_for_other_accountabilities: [],
            PaymentDecision: 0,
            otherAccountabilitiesPaymentDetails: [],
            attendanceFill: [],
            finesPay: [],
            school_year: [],
            school_year_input: this.school_year_session,


        }
    },

    mounted(){



    },
    created(){
        this.fetchData();
        this.showSchoolYear();

    },

    methods:{
        showSchoolYear(){
            axios.get(`get_school_year/${this.org_id}`)
                .then(response => {
                    this.school_year = response.data;
                })
                .catch(error => {
                    console.log(error)
                });
        },
        getTableData1(){
            // Get a reference to the table
            var table = document.getElementById('temporaryList');

            // Initialize an array to store the table data without the first row
            var tableDataWithoutFirstRow = [];

            // Iterate through the rows of the table, starting from the second row
            for (var i = 1; i < table.rows.length; i++) {
            var rowData = [];

            // Iterate through the cells of the current row
            for (var j = 0; j < table.rows[i].cells.length; j++) {
                // Push the cell value to the rowData array
                rowData.push(table.rows[i].cells[j].textContent);
            }

            // Push the row data to the tableDataWithoutFirstRow array
            tableDataWithoutFirstRow.push(rowData);
            }

            // Output the tableDataWithoutFirstRow array
            // console.log(tableDataWithoutFirstRow);
            this.attendanceFill = tableDataWithoutFirstRow;
            // console.log(this.attendanceFill)
        },

        FinesPayment(){
            // for adding payment database
            axios.post('/FinesAccountabilityPayment', this.finesPay)
                    .then(response => {
                        // this.showSucces(response.data.message);
                        // this.fetchData();
                        location.reload();
                        console.log(response.data)
                    })
                    .catch(error => {
                        alert(error)

                });

                console.log(this.attendanceFill)

            // //for adding to attendance to remove the list but leave remarks of 1
            axios.post('/attendanceFill', this.attendanceFill)
                .then(response => {
                    // this.showSucces(response.data.message);
                    // this.fetchData();
                    // location.reload();
                    console.log(response.data)
                })
                .catch(error => {
                    alert(error)

            });

        },
        OtherAccountabilityPayment(){

            // console.log(this.otherAccountabilitiesPaymentDetails)
            axios.post('/OtherAccountabilityPayment', this.otherAccountabilitiesPaymentDetails)
                    .then(response => {
                        // this.showSucces(response.data.message);
                        // this.fetchData();
                        location.reload();
                    })
                    .catch(error => {
                        alert(error)

                });
        },
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
            // console.log(this.overall_fines_list)
            this.temporary_list= [];
            this.overall_fines_list.forEach(fines=>{
                if (fines.user_id == user_id){
                    this.temporary_list.push({
                        name: fines.name,
                        user_id: fines.user_id,
                        event_id: fines.event_id,
                        event_name: fines.event_name,
                        amount: fines.amount,
                        missing_session: fines.missing_session,
                        accountability_type: fines.accountability_type,
                        date: fines.date,
                    });
                }
            })
            // console.log(this.temporary_list)
        },


        fetchData(){
            this.events = [];
            this.attendance = [];
            this.overall_fines_list = [];
            this.fines_list = [];
            this.other_accountabilities_list = [];
            axios.get(`/fines_list/${this.org_id}/${this.school_year_input}`)

                    .then(response => {

                        //FOR FINES LOGIC
                        const events_with_attendance = response.data.accountabilities_fines;
                        let users = response.data.user;
                        let user_orgs = response.data.user_orgs;
                        const year_level = response.data.year_level;
                        const year_level_exempted = response.data.year_level_exempted;
                        let free_fines = response.data.free_fines;
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

                //SET USERS THAT IS ONLY COVERED WITH THE ORGANIZATION
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

                        usersInOrg.forEach(user => {

                            this.events.forEach(event => {
                                //exclude the exempted students
                                for (const exemption of year_level_exempted) {
                                    if (user.year_level === exemption.year_level_id && event.event_id === exemption.event_id) {
                                        // Do nothing
                                        return;
                                    }
                                }

                                //logic for missing sessions
                                if (!userSessionsPresent[user.id] || !userSessionsPresent[user.id][event.event_id] ||
                                    !userSessionsPresent[user.id][event.event_id].has(event.session)) {
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
                        // console.log(missingSessions)


                        // console.log("Missing sessions:", missingSessions);
                        missingSessions.forEach(overall_fines_list=>{
                                events_with_attendance.forEach(event_name=>{
                                    if(overall_fines_list.event_id === event_name.event_id){
                                        const missing = {
                                            name: overall_fines_list.name,
                                            user_id: overall_fines_list.user_id,
                                            event_name: event_name.name,
                                            event_id: event_name.event_id,
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
                        // console.log(accountability_paid)
                        // console.log(organization_accountability_set)
                        const studentsWhoPaid = new Set(accountability_paid.map(entry => entry.student_id));

                        // Get a Set of unique accountability types from organization_accountability_set
                        const accountabilityTypes = new Set(organization_accountability_set.map(entry => entry.accountability_name));

                        // Find students who have not paid for their accountabilities and replace accountability_type
                        const studentsNotPaid = usersInOrg.reduce((acc, user) => {
                        if (!studentsWhoPaid.has(user.id) ) {
                            // Push user details with an indication of not being paid and relevant accountability info
                            organization_accountability_set.forEach(entry => {
                            acc.push({
                                accountability_id: entry.accountability_id,
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

                     // this.other_accountabilities_list = [];
                    // Display students who have not paid for their accountabilities with replaced accountability_type
                    studentsNotPaid.forEach(items =>{
                        this.other_accountabilities_list.push({
                                accountability_id: items.accountability_id,
                                name: items.name,
                                user_id: items.user_id,
                                amount: items.amount,
                                accountability_type: items.accountability_type
                            })
                    })


                    free_fines.forEach(fines_free => {
                        // console.log(fines_free);
                        this.fines_list.forEach(list_fines => {
                            // console.log(list_fines)
                            if (fines_free.student_id != list_fines.user_id ){
                                this.fines_list.push({
                                name: list_fines.name,
                                user_id: list_fines.user_id,
                                event_id: list_fines.event_id,
                                total_fines: list_fines.total_fines,
                                missing_session: list_fines.missing_session,
                                accountability_type: list_fines.accountability_type
                            })
                            }
                            else{
                                this.fines_list=[]
                            }
                        });
                    });
                    console.log(this.fines_list)
                    // this.fines_list.push({
                    //             name: aggregated.name,
                    //             user_id: aggregated.user_id,
                    //             event_id: aggregated.event_id,
                    //             total_fines: aggregated.total_amount,
                    //             missing_session: aggregated.missing_session,
                    //             accountability_type: aggregated.accountability_type
                    //         })

                    this.filtered_items_for_fines = this.fines_list;
                    this.filtered_items_for_other_accountabilities = this.other_accountabilities_list;

                    })
                    .catch(error => {
                        console.log(error)

                });
        },

        showSucces(message){
            toast.success(message),{
                autoClose: 100,
            }
        },


    printTable() {
        // Clone the table element to avoid modifying the original table
        const tableToPrint = document.getElementById('accountabilities-table').cloneNode(true);

        // Remove or hide the "Actions" column in each row
        const actionsColumnIndex = 4; // Assuming "Actions" is the fifth column (index 4)
        const rows = tableToPrint.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            if (cells.length > actionsColumnIndex) {
                // Remove the cell from the DOM
                cells[actionsColumnIndex].parentNode.removeChild(cells[actionsColumnIndex]);
            }
        }

        // Hide the header cell for the "Actions" column
        const headerRow = tableToPrint.getElementsByTagName('thead')[0].getElementsByTagName('tr')[0];
        if (headerRow) {
            const headerCell = headerRow.getElementsByTagName('th')[actionsColumnIndex];
            if (headerCell) {
                headerCell.style.display = 'none';
            }
        }

        // Open a new window for printing
        const printWindow = window.open('', '_blank');

        // Create a new HTML document in the print window
        printWindow.document.write(`
            <html>
            <head>
                <title>Print</title>
                <!-- Include Bootstrap stylesheet link -->
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            </head>
            <body>
                <!-- Add a title before the table -->
                <h2>Unpaid Accountabilities</h2>

                <!-- Add Bootstrap table classes -->
                <table class="table table-bordered table-striped">
                    ${tableToPrint.innerHTML}
                </table>
            </body>
            </html>
        `);

        // Close the HTML document
        printWindow.document.close();
        printWindow.print();
    },

    downloadTable() {
        // Get the table data
        const tableData = this.getTableData();

        // Create a worksheet
        const ws = XLSX.utils.aoa_to_sheet(tableData);

        // Create a workbook
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'Sheet 1');

        // Save the workbook as an Excel file
        XLSX.writeFile(wb, 'UnpaidAccountabilities.xlsx');
    },

    getTableData() {
        // Get a reference to the table
        const table = document.getElementById('accountabilities-table');

        // Initialize an array to store the table data
        const tableData = [];

        // Iterate through the rows of the table
        for (let i = 0; i < table.rows.length; i++) {
            const rowData = [];

            // Iterate through the cells of the current row, excluding the last one
            for (let j = 0; j < table.rows[i].cells.length - 1; j++) {
            // Push the cell value to the rowData array
            rowData.push(table.rows[i].cells[j].textContent);
            }

            // Push the row data to the tableData array
            tableData.push(rowData);
        }

        // Return the table data
        return tableData;
},



    }


}

</script>

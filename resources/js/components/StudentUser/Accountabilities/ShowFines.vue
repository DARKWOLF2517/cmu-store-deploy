<template>
 <div class="mt-2">
                <div class="row head-container">
                    <div class="col-md-6 col-sm-12">
                        <div class="input-container">
                            <i class="fa fa-search"></i>
                            <input type="text" placeholder="Search Event" v-model="searchTerm" @input="filterItems">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end; gap: 20px;">
                        <!-- <button class="btn sort-btn"><i class="bi bi-sort-up"></i></button> -->
                        <div class="select-dropdown" style="width: 70%;">
                            <select id="sort-select" class="form-control" style="text-align: center;" v-model="school_year_input"  @change="fetchData">
                                <option value="0" disabled selected>Select Semester</option>
                                <option v-for="school_year in this.school_year" :value="school_year['id']" >{{ school_year['school_year'] }}</option>
                            </select>
                        </div>
                        <!-- <div class="select-dropdown" style="width: 30%;">
                        <select id="sort-select" class="form-control" style="text-align: center;">
                            <option value="">All</option>
                            <option value="option1">Pending</option>
                            <option value="option2">Completed</option>
                        </select>
                    </div> -->

                    </div>
                </div>
            </div>
            <h3 class="mt-2"><i class="fas fa-list"></i> Accountabilities</h3>
            <div id="accountability-container">
                <div class="accountability-cards-list">
    <div class="stud-accountability-card">
        <div class="card-body text-center">
            <h5 class="card-title mt-4"><strong>USSCO </strong></h5>
            <small>CMU-University Senior Students' Council</small>
            <h2 class="total-payment bold">&#8369; 10,000</h2>
            <!-- Use "&#8369;" for the peso sign -->
        </div>
        <div class="card-footer text-center">
            <button class="btn button-secondary" style="background-color: #4fb98e; color: #fefffe;" data-bs-toggle="modal" data-bs-target="#seeMoreAccountability">
                <i class="fas fa-eye"></i> See more
            </button>
        </div>
    </div>

    <!-- Repeat the structure for other cards -->

    <div class="stud-accountability-card">
        <div class="card-body text-center">
            <h5 class="card-title mt-4"><strong>SSC </strong></h5>
            <small>CMU-Supreme Student Council</small>
            <h2 class="total-payment bold">&#8369; 10,000</h2>
            <!-- Use "&#8369;" for the peso sign -->
        </div>
        <div class="card-footer text-center">
            <button class="btn button-secondary" style="background-color: #4fb98e; color: #fefffe;" data-bs-toggle="modal" data-bs-target="#seeMoreAccountability">
                <i class="fas fa-eye"></i> See more
            </button>
        </div>
    </div>
</div>

</div>

    <!-- <div class="mt-2">
            <div class="row head-container">
                <div class="col-md-6 col-sm-12">
                    <h4><i class="fas fa-list mt-2"></i>  Accountabilities</h4>
                </div>
                <div class="col-md-6 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end;">
                    <div class="select-dropdown">
                        <select id="sort-select" class="form-control" style="text-align: center;" v-model="school_year_input"  @change="fetchData">
                            <option value="0" disabled selected>Select School Year</option>
                            <option v-for="school_year in this.school_year" :value="school_year['id']" >{{ school_year['school_year'] }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div> -->


        <!-- <div class="scroll-pane">
            <div id="accountabilities-table">
                <table class="student-accountabilities" id="accountabilities-table">
                        <tr>
                            <th style="width: 30%; background-color: #53967c; color: white;"> <h5> <b>Student Name</b></h5></th>
                            <td style=" background-color: #53967c; color: white;"><h5>{{ this.name }}</h5></td>
                        </tr>
                        <tr>
                            <th> <h6><b>Accountabilities</b> </h6></th>
                            <td> <h6><b>Amount</b></h6>  </td>
                        </tr>
                        <tr>
                            <th>Fines</th>
                            <td>{{fines}} -->
                                <!-- <i class="fas fa-eye ml-6">see more</i> -->
                            <!-- </td>
                        </tr> -->
                        <!-- <tr v-for="accountability in this.accountabilityList">
                            <th>{{ accountability['accountability_name'] }}</th>
                            <td >{{ accountability['amount'] }}</td>

                        </tr> -->


<!--
                    </table>
            </div>
        </div> -->

<!-- Modal -->
<div class="modal fade" id="seeMoreAccountability" tabindex="-1" aria-labelledby="seeMoreAccountabilityLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h6 class="modal-title" id="seeMoreAccountabilityLabel">USSCO - CMU University Senior Students' Council</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Detailed Information -->
                <div class="mb-3">
                    <label for="totalPayment" class="form-label">Total Payment</label>
                    <h3 id="totalPayment">&#8369; 10,000</h3>
                    <!-- Use "&#8369;" for the peso sign -->
                </div>

                <table class="student-accountabilities" id="accountabilities-table">
                        <tr style="background-color: #84c0b4; color: #fefffe;">
                            <th> <h6><b>Accountabilities</b> </h6></th>
                            <td> <h6><b>Amount</b></h6>  </td>
                        </tr>
                        <tr>
                            <th>Fines</th>
                            <td>{{fines}}
                                </td>
                                </tr>
                                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</template>

<script>
export default{
    props: ['user_id', 'name', 'org_id','school_year_session'],
    data(){
        return{
            attendanceCount: [],
            fines: 0,
            accountabilityList:[],
            school_year: [],
            school_year_input: this.school_year_session,
            accountabilityList: [],
            searchTerm: '',
            filtered_accountabilities: [],
        }
    },
    mounted() {
        this.fetchData();
        this.showSchoolYear();
        // console.log(this.name)

    },
    methods:{
        showSchoolYear(){

            axios.get(`get_school_year/${this.org_id}`)
                .then(response => {
                    // console.log(response.data)
                    this.school_year = response.data;
                    // console.log(response.data)
                })
                .catch(error => {
                    console.log(error)
                });

        },
        fetchData(){
            this.attendanceCount= [],
            this.fines= 0,
            this.accountabilityList=[],
            axios.get(`/get_accountabilities/${this.org_id}/${this.school_year_input}`)
                    .then(response => {
                        this.accountabilityList = response.data;
                    })
                    .catch(error => {
                        alert(error)

                });

                this.fetchEventsWithAttendance();
        },

        fetchEventsWithAttendance(){
            axios.get(`/accountabilities/${this.org_id}/${this.school_year_input}`)
                .then(response => {
                    console.log(response.data)
                    const data = response.data;
                    data.forEach(events => {
                        //get the data of the student attendance and compile it to the array
                        const attendanceRecord = {
                            // student_id: events,
                            event_id: events.event_id,
                            fines: events.fines,
                            session_count: events.attendance_count,
                        };
                        const attendance = events.attendance;
                        let attendanceCount = 0;
                        let student_id = '';
                        attendance.forEach(id => {
                            if (id.user_id == this.user_id) {
                                attendanceCount++;
                                student_id  = this.user_id;
                            }
                        });
                        // Update the events.attendance_count with the total attendance count for the user
                        attendanceRecord.attendance_count = attendanceCount;
                        attendanceRecord.student_id = student_id;


                        if (attendanceRecord.session_count > attendanceRecord.attendance_count){
                            // console.log(attendanceRecord.event_id + " has fines " + attendanceRecord.fines)
                            attendanceRecord.finalSession = attendanceRecord.session_count - attendanceRecord.attendance_count;
                            this.fines += attendanceRecord.fines * attendanceRecord.finalSession;
                            // console.log(attendanceRecord.finalSession)
                        }

                        this.attendanceCount.push(attendanceRecord);
                    });
                    console.log(this.attendanceCount);


                })
                .catch(error => {
                    // alert(error)
                    console.log(error)
                });
        },

    },

}
</script>

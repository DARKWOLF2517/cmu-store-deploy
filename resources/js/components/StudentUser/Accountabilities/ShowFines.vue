<template>

    <div class="mt-2">
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
        </div>
        <div class="scroll-pane">
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
                            <td>{{fines}}</td>
                        </tr>
                        <tr v-for="accountability in this.accountabilityList">
                            <th>{{ accountability['accountability_name'] }}</th>
                            <td >{{ accountability['amount'] }}</td>
                        </tr>
                    </table>
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

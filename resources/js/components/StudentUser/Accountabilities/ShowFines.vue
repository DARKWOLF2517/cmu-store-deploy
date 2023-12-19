<template>

    <div class="mt-2">
            <div class="row head-container">
                <div class="col-md-6 col-sm-12">
                    <h4><i class="fas fa-bars"></i> Accountabilities</h4>
                </div>
                <div class="col-md-6 col-sm-12" style="display: flex; align-items: center; justify-content: flex-end;">
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
        <div class="scroll-pane">
            <div class="container" id="accountabilities-table">
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
                            <td class="paid">{{fines}}</td>
                        </tr>
                        <tr v-for="accountability in this.accountabilityList">
                            <th>{{ accountability['accountability_name'] }}</th>
                            <td class="unpaid">{{ accountability['amount'] }}</td>
                        </tr>
                    </table>
            </div>
        </div>
</template>

<script>
export default{
    props: {
        user_id: Number,
        name: String,
        org_id: Number

},
    data(){
        return{
            attendanceCount: [],
            fines: 0,
            accountabilityList:[],
        }
    },
    mounted() {
        this.fetchEventsWithAttendance();
        this.fetchData();
        // console.log(this.name)

    },
    methods:{
        fetchData(){
            axios.get(`/get_accountabilities/${this.org_id}`)
                    .then(response => {
                        this.accountabilityList = response.data;
                    })
                    .catch(error => {
                        alert(error)

                });
        },

        fetchEventsWithAttendance(){
            axios.get(`/accountabilities/${this.org_id}`)
                .then(response => {
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
